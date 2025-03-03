<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Governate;

class GovernateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $governates = [
            'Cairo',
            'Giza',
            'Alexandria',
            'Dakahlia',
            'Red Sea',
            'Beheira',
            'Fayoum',
            'Gharbia',
            'Ismailia',
            'Menoufia',
            'Minya',
            'Qalyubia',
            'New Valley',
            'Suez',
            'Aswan',
            'Assiut',
            'Beni Suef',
            'Port Said',
            'Damietta',
            'South Sinai',
            'Kafr El Sheikh',
            'Matrouh',
            'Luxor',
            'Qena',
            'North Sinai',
            'Sohag',
            'Sharqia'
        ];

        foreach ($governates as $governate) {
            Governate::create(['name' => $governate]);
        }
    }

}
