<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderTrackingHistory;

class FetchTrackingStatus extends Command
{
    protected $signature = 'tracking:fetch';
    protected $description = 'Fetch tracking status for orders and store in order_tracking_history';

    public function handle()
    {
        try {
            // Get all orders with non-null tracking_no
            $orders = Order::whereNotNull('tracking_no')->get();

            if ($orders->isEmpty()) {
                $this->info('No orders with tracking numbers found at ' . now());
                return;
            }

            // Get the latest access token
            $accessToken = \App\Models\AccessToken::latest()->first()->access_token ?? null;

            if (!$accessToken) {
                Log::error('No access token found');
                $this->error('No access token found');
                return;
            }

            foreach ($orders as $order) {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                ])->get('https://api-dev.pos.com.my/api/tracking-external/v4', [
                    'id' => $order->tracking_no,
                    'accountNo' => '8800649634',
                ]);

                if ($response->successful()) {
                    $trackingData = $response->json();

                    foreach ($trackingData as $status) {
                        // Update or create tracking history record, ensuring no duplicates
                        OrderTrackingHistory::updateOrCreate(
                            [
                                'order_id' => $order->id,
                                'process' => $status['process'],
                            ],
                            [
                                'tracking_no' => $order->tracking_no,
                                'type' => $status['type'] ?? null,
                                'date' => $status['date'] ? \Carbon\Carbon::parse($status['date']) : null,
                                'office' => $status['office'] ?? null,
                                'error_details' => $status['ErrorDetails'] ?? null,
                                'event_type' => $status['EventType'] ?? null,
                                'failure_reason' => $status['FailureReason'] ?? null,
                                'epod' => $status['Epod'] ?? null,
                                'source' => $status['source'] ?? null,
                            ]
                        );
                    }

                    $this->info("Tracking status updated for order {$order->id} at " . now());
                } else {
                    Log::error("Failed to fetch tracking for order {$order->id}: " . $response->body());
                    $this->error("Failed to fetch tracking for order {$order->id}");
                }
            }
        } catch (\Exception $e) {
            Log::error('Error in FetchTrackingStatus: ' . $e->getMessage());
            $this->error('Error fetching tracking status: ' . $e->getMessage());
        }
    }
}
