<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingSeeder extends Seeder
{
    public function run()
    {
        DB::table('app_settings')->insert([
            [
                'variable' => 'free_shipping',
                'value'    => '50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'variable' => 'shipping_charges',
                'value'    => '20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
