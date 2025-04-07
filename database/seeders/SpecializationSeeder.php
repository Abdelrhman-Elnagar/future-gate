<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialization;


class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specialization::create(['name' => 'أدبى']);
        Specialization::create(['name' => 'علمى علوم']);
        Specialization::create(['name' => 'علمى رياضة']);
    }
}
