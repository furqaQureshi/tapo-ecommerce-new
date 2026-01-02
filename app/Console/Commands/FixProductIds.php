<?php

namespace App\Console\Commands;

use App\Models\ProductBundle;
use Illuminate\Console\Command;

class FixProductIds extends Command
{
    protected $signature = 'product-bundles:fix-product-ids';
    protected $description = 'Convert product_ids strings to integers in the product_bundles table';

    public function handle()
    {
        $bundles = ProductBundle::all();
        $updated = 0;

        foreach ($bundles as $bundle) {
            if (is_array($bundle->product_ids)) {
                // Convert string IDs to integers
                $convertedIds = array_map('intval', $bundle->product_ids);
                if ($bundle->product_ids !== $convertedIds) {
                    $bundle->product_ids = $convertedIds;
                    $bundle->save();
                    $updated++;
                    $this->info("Updated bundle ID {$bundle->id}: product_ids converted to " . json_encode($convertedIds));
                }
            } elseif (is_string($bundle->product_ids)) {
                // Handle cases where product_ids is a string (e.g., "1,2,3")
                $ids = array_filter(array_map('intval', explode(',', $bundle->product_ids)));
                $bundle->product_ids = $ids;
                $bundle->save();
                $updated++;
                $this->info("Updated bundle ID {$bundle->id}: product_ids converted from string to " . json_encode($ids));
            }
        }

        $this->info("Updated {$updated} product bundle records.");
    }
}
