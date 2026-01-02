<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PointSetting;

class PointSettingsTableSeeder extends Seeder
{
    public function run()
    {
        PointSetting::create([
            'points_per_rm' => 100,
            'rm_per_point' => 0.01,
        ]);
    }
}