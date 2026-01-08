<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryIntervalSeeder extends Seeder
{
    public function run()
    {
        $intervals = [
            ['name' => 'Every 2 weeks', 'weeks' => 2, 'is_default' => false],
            ['name' => 'Every 4 weeks', 'weeks' => 4, 'is_default' => true],
            ['name' => 'Every 6 weeks', 'weeks' => 6, 'is_default' => false],
        ];

        foreach ($intervals as $i) {
            DB::table('delivery_intervals')->updateOrInsert(
                ['weeks' => $i['weeks']],
                ['name' => $i['name'], 'is_default' => $i['is_default'], 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
