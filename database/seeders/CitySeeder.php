<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            ['name' => 'George Town', 'state' => 'Penang', 'latitude' => 5.41667, 'longitude' => 100.33333, 'population' => 794313, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Kuala Lumpur', 'state' => 'Kuala Lumpur', 'latitude' => 3.1390, 'longitude' => 101.6869, 'population' => 1982112, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Ipoh', 'state' => 'Perak', 'latitude' => 4.59748, 'longitude' => 101.0750, 'population' => 759952, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Kuching', 'state' => 'Sarawak', 'latitude' => 1.5535, 'longitude' => 110.3593, 'population' => 349147, 'timezone' => 'Asia/Kuching'],
            ['name' => 'Johor Bahru', 'state' => 'Johor', 'latitude' => 1.4655, 'longitude' => 103.7578, 'population' => 858118, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Putrajaya', 'state' => 'Putrajaya', 'latitude' => 2.9353, 'longitude' => 101.6910, 'population' => 109202, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Kota Kinabalu', 'state' => 'Sabah', 'latitude' => 5.9749, 'longitude' => 116.0724, 'population' => 500425, 'timezone' => 'Asia/Kuching'],
            ['name' => 'Shah Alam', 'state' => 'Selangor', 'latitude' => 3.0736, 'longitude' => 101.5183, 'population' => 812327, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Malacca City', 'state' => 'Malacca', 'latitude' => 2.1896, 'longitude' => 102.2501, 'population' => 453904, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Alor Setar', 'state' => 'Kedah', 'latitude' => 6.1248, 'longitude' => 100.3678, 'population' => 423868, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Miri', 'state' => 'Sarawak', 'latitude' => 4.3993, 'longitude' => 113.9916, 'population' => 248877, 'timezone' => 'Asia/Kuching'],
            ['name' => 'Petaling Jaya', 'state' => 'Selangor', 'latitude' => 3.1073, 'longitude' => 101.6067, 'population' => 771687, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Kuala Terengganu', 'state' => 'Terengganu', 'latitude' => 5.3302, 'longitude' => 103.1408, 'population' => 375424, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Iskandar Puteri', 'state' => 'Johor', 'latitude' => 1.4167, 'longitude' => 103.6667, 'population' => 575977, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Seberang Perai', 'state' => 'Penang', 'latitude' => 5.3833, 'longitude' => 100.3833, 'population' => 946092, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Seremban', 'state' => 'Negeri Sembilan', 'latitude' => 2.7297, 'longitude' => 101.9381, 'population' => 681541, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Subang Jaya', 'state' => 'Selangor', 'latitude' => 3.0438, 'longitude' => 101.5806, 'population' => 902086, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Pasir Gudang', 'state' => 'Johor', 'latitude' => 1.4657, 'longitude' => 103.9077, 'population' => 312437, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Kuantan', 'state' => 'Pahang', 'latitude' => 3.8077, 'longitude' => 103.3260, 'population' => 548014, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Klang', 'state' => 'Selangor', 'latitude' => 3.0449, 'longitude' => 101.4456, 'population' => 902025, 'timezone' => 'Asia/Kuala_Lumpur'],
            // Additional prominent cities from web results
            ['name' => 'Batu Pahat', 'state' => 'Johor', 'latitude' => 1.8548, 'longitude' => 102.9325, 'population' => 156236, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Kluang', 'state' => 'Johor', 'latitude' => 2.0305, 'longitude' => 103.3169, 'population' => 169828, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Kulai', 'state' => 'Johor', 'latitude' => 1.6561, 'longitude' => 103.6032, 'population' => 132429, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Muar', 'state' => 'Johor', 'latitude' => 2.0442, 'longitude' => 102.5689, 'population' => 127897, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Sungai Petani', 'state' => 'Kedah', 'latitude' => 5.6470, 'longitude' => 100.4877, 'population' => 228843, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Kota Bharu', 'state' => 'Kelantan', 'latitude' => 6.1333, 'longitude' => 102.2386, 'population' => 314964, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Labuan', 'state' => 'Labuan', 'latitude' => 5.2803, 'longitude' => 115.2475, 'population' => 87365, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['name' => 'Sandakan', 'state' => 'Sabah', 'latitude' => 5.8402, 'longitude' => 118.1179, 'population' => 396290, 'timezone' => 'Asia/Kuching'],
            ['name' => 'Tawau', 'state' => 'Sabah', 'latitude' => 4.2448, 'longitude' => 117.8912, 'population' => 397904, 'timezone' => 'Asia/Kuching'],
            ['name' => 'Bintulu', 'state' => 'Sarawak', 'latitude' => 3.1667, 'longitude' => 113.0333, 'population' => 150617, 'timezone' => 'Asia/Kuching'],
        ];

        City::insert($cities);
    }
}
