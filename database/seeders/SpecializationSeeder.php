<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    public function run(): void
    {
        $specializations = [
            ['name' => 'أدبي'],        // Literary
            ['name' => 'علمي علوم'],   // Scientific - Sciences
            ['name' => 'علمي رياضة'],  // Scientific - Mathematics
        ];

        foreach ($specializations as $specialization) {
            Specialization::firstOrCreate(
                ['name' => $specialization['name']],
                $specialization
            );
        }
    }
}
