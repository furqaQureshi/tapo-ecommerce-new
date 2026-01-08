<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            ['variable' => 'free_shipping', 'value' => '50'],
            ['variable' => 'shipping_charges', 'value' => '20'],
            ['variable' => 'subscription_discount', 'value' => '5'],
            ['variable' => 'subscription_free_shipping', 'value' => '150'],
        ];

        foreach ($settings as $s) {
            DB::table('app_settings')->updateOrInsert(
                ['variable' => $s['variable']],
                ['value' => $s['value'], 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}
