<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateProductVariantNamesSeeder extends Seeder
{
    public function run(): void
    {
        $variants = DB::table('product_variants')->get();

        foreach ($variants as $variant) {
            $updatedName = preg_replace('/\s*\(#\d+\)$/', '', $variant->name);

            if ($updatedName !== $variant->name) {
                DB::table('product_variants')
                    ->where('id', $variant->id)
                    ->update(['name' => $updatedName]);
            }
        }

        echo "Product variant names updated successfully.\n";
    }
}
