<?php

namespace App\Console\Commands;

use App\Models\OrderItem;
use App\Services\MooGoldService;
use App\Services\ProductPayoutService;
use App\Services\SynnStoreService;
use Illuminate\Console\Command;

class ProcessProductPayouts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:process-payouts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes product payouts to suppliers via API and handles commission deduction';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting product payout processing...");

        $orderItems = OrderItem::with('product.apiServices')
            ->where('status', '!=', 'completed')
            ->get();

        foreach ($orderItems as $orderItem) {
            $product = $orderItem->product;

            if (!$product || $product->apiServices->isEmpty()) {
                $this->warn("Skipping: Product missing or no API services linked.");
                continue;
            }

            foreach ($product->apiServices as $apiService) {
                if ($apiService->slug == 'moo-gold') {
                    $processor = new ProductPayoutService(new MooGoldService());
                    $success = $processor->MooGoldprocess($orderItem);

                    if ($success) {
                        $this->info("OrderItem ID {$orderItem->id} processed successfully.");
                        break;
                    } else {
                        $this->warn("MooGold failed for OrderItem ID {$orderItem->id}. Trying next service...");
                    }
                } elseif ($apiService->slug == 'synn-store') {
                    $processor = new ProductPayoutService(new SynnStoreService());
                    $success = $processor->SynnStoreProcess($orderItem);

                    if ($success) {
                        $this->info("OrderItem ID {$orderItem->id} processed successfully.");
                        break;
                    } else {
                        $this->warn("Synn Store failed for OrderItem ID {$orderItem->id}. Trying next service...");
                    }
                }
            }
        }

        $this->info("Done processing payouts.");
    }
}
