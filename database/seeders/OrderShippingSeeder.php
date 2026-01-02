<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderShippingSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_shippings')->insert([
            [
                'region' => 'peninsular',
                'min_order' => 0,
                'max_order' => 99.99,
                'price' => 5.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'region' => 'peninsular',
                'min_order' => 100,
                'max_order' => null,
                'price' => 0.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'region' => 'sabah_sarawak',
                'min_order' => 0,
                'max_order' => 99.99,
                'price' => 15.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'region' => 'sabah_sarawak',
                'min_order' => 100,
                'max_order' => null,
                'price' => 15.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
