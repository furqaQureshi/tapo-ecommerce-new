<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;

class UpdateSynnTransactions extends Command
{
    protected $signature = 'synn:update-transactions';
    protected $description = 'Update Synn transactions status from API';

    public function handle()
    {
        Log::info('=== Synn Transaction Update Started ===');

        $items = OrderItem::with('order')
            ->where('source', 'S')
            ->whereNotNull('response')
            ->get();

        Log::info("Total items found to process: {$items->count()}");

        foreach ($items as $item) {
            Log::info("Processing OrderItem ID: {$item->id}");

            $responseData = json_decode($item->response, true);
            $invoice = isset($responseData['invoice']) ? trim($responseData['invoice']) : null;

            if (!$invoice) {
                Log::warning("Invoice not found for OrderItem ID: {$item->id}");
                continue;
            }

            Log::info("Invoice found: {$invoice}");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_INTERFACE, "217.21.95.211");
            curl_setopt_array($ch, [
                CURLOPT_URL => 'https://www.synnmlbb.com/api/v1/detail-transaction',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode(['invoice' => $invoice]),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'x-user-key: mdh0NIXRgPSixriu3LL8'
                ]
            ]);

            $apiResponse = curl_exec($ch);

            if (curl_errno($ch)) {
                $error = curl_error($ch);
                Log::error("Curl error for Invoice {$invoice}: {$error}");
                curl_close($ch);
                continue;
            }
            curl_close($ch);

            Log::info("Raw API Response for Invoice {$invoice}: {$apiResponse}");

            $data = json_decode($apiResponse, true);

            if (isset($data['success']) && $data['success'] && isset($data['data']['transaction']['status'])) {
                $status = $data['data']['transaction']['status'];
                $item->source_status = $status;

                if (strtolower($status) === 'success') {
                    $item->status = 'completed';
                    Log::info("OrderItem ID {$item->id} marked as COMPLETED.");
                } elseif (strtolower($status) === 'failed') {
                    $item->status = 'failed';
                    Log::info("OrderItem ID {$item->id} marked as FAILED.");
                } else {
                    Log::info("OrderItem ID {$item->id} source_status updated to: {$status}");
                }

                $order = $item->order;

                if ($order && $order->items()->count() === 1) {
                    if (strtolower($status) === 'success') {
                        $order->status = 'completed';
                        Log::info("Order ID {$order->id} marked as COMPLETED (only one item).");
                    } elseif (strtolower($status) === 'failed') {
                        $order->status = 'failed';

                        Log::info("Order ID {$order->id} marked as FAILED (only one item).");
                    }
                    $order->source_status = strtolower($status);
                    $order->save();
                } else {
                    Log::info("Order ID {$order->id} NOT updated because it has multiple order_items.");
                }

                $item->save();
            } else {
                Log::warning("Invalid API response for Invoice: {$invoice}");
            }
        }

        Log::info('=== Synn Transaction Update Finished ===');
    }
}
