<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University; // Assuming you have a University model

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = [
            [
                'name' => 'Cairo University',
                'location' => 'Cairo',
                'website' => 'https://cu.edu.eg',
                'logo' => 'logos/cairo_university.png', // Example path
                'description' => "One of Egypt's oldest and most prestigious universities, established in 1908.",
                'established_year' => 1908,
                'email' => 'info@cu.edu.eg',
                'phone' => '+20235676100',
                'address' => 'Giza, Egypt',
                'ranking' => 1, // Example ranking
            ],
            [
                'name' => 'Ain Shams University',
                'location' => 'Cairo',
                'website' => 'https://www.asu.edu.eg',
                'logo' => 'logos/ain_shams.png', // Example path
                'description' => 'A leading university in Egypt, founded in 1950.',
                'established_year' => 1950,
                'email' => 'info@asu.edu.eg',
                'phone' => '+20226834222',
                'address' => 'Cairo, Egypt',
                'ranking' => 2, // Example ranking
            ],
            [
                'name' => 'Alexandria University',
                'location' => 'Alexandria',
                'website' => 'https://alexu.edu.eg',
                'logo' => 'logos/alexandria_university.png', // Example path
                'description' => 'A major university in Alexandria, established in 1938.',
                'established_year' => 1938,
                'email' => 'info@alexu.edu.eg',
                'phone' => '+2035921678',
                'address' => 'Alexandria, Egypt',
                'ranking' => 3, // Example ranking
            ],
            [
                'name' => 'Assiut University',
                'location' => 'Assiut',
                'website' => 'https://www.aun.edu.eg',
                'logo' => 'logos/assiut_university.png', // Example path
                'description' => 'A prominent university in Upper Egypt, founded in 1957.',
                'established_year' => 1957,
                'email' => 'info@aun.edu.eg',
                'phone' => '+20882323200',
                'address' => 'Assiut, Egypt',
                'ranking' => 4, // Example ranking
            ],
            [
                'name' => 'Mansoura University',
                'location' => 'Mansoura',
                'website' => 'https://www.mans.edu.eg',
                'logo' => 'logos/mansoura_university.png', // Example path
                'description' => 'A leading university in the Nile Delta, established in 1972.',
                'established_year' => 1972,
                'email' => 'info@mans.edu.eg',
                'phone' => '+20502203833',
                'address' => 'Mansoura, Egypt',
                'ranking' => 5, // Example ranking
            ],
            [
                'name' => 'Zagazig University',
                'location' => 'Zagazig',
                'website' => 'https://www.zu.edu.eg',
                'logo' => 'logos/zagazig_university.png', // Example path
                'description' => 'A major university in the Sharqia Governorate, founded in 1974.',
                'established_year' => 1974,
                'email' => 'info@zu.edu.eg',
                'phone' => '+20552230444',
                'address' => 'Zagazig, Egypt',
                'ranking' => 6, // Example ranking
            ],
            [
                'name' => 'Helwan University',
                'location' => 'Helwan',
                'website' => 'https://www.helwan.edu.eg',
                'logo' => 'logos/helwan_university.png', // Example path
                'description' => 'A public university in Helwan, established in 1975.',
                'established_year' => 1975,
                'email' => 'info@helwan.edu.eg',
                'phone' => '+20225580000',
                'address' => 'Helwan, Egypt',
                'ranking' => 7, // Example ranking
            ],
            [
                'name' => 'Minia University',
                'location' => 'Minia',
                'website' => 'https://www.minia.edu.eg',
                'logo' => 'logos/minia_university.png', // Example path
                'description' => 'A university in Minia, founded in 1976.',
                'established_year' => 1976,
                'email' => 'info@minia.edu.eg',
                'phone' => '+20862332000',
                'address' => 'Minia, Egypt',
                'ranking' => 8, // Example ranking
            ],
            [
                'name' => 'Suez Canal University',
                'location' => 'Ismailia',
                'website' => 'https://www.suez.edu.eg',
                'logo' => 'logos/suez_canal_university.png', // Example path
                'description' => 'A university located near the Suez Canal, established in 1976.',
                'established_year' => 1976,
                'email' => 'info@suez.edu.eg',
                'phone' => '+20643220000',
                'address' => 'Ismailia, Egypt',
                'ranking' => 9, // Example ranking
            ],
            [
                'name' => 'Tanta University',
                'location' => 'Tanta',
                'website' => 'https://www.tanta.edu.eg',
                'logo' => 'logos/tanta_university.png', // Example path
                'description' => 'A university in Tanta, founded in 1972.',
                'established_year' => 1972,
                'email' => 'info@tanta.edu.eg',
                'phone' => '+20403310000',
                'address' => 'Tanta, Egypt',
                'ranking' => 10, // Example ranking
            ],
        ];

        foreach ($universities as $university) {
            University::create($university);
        }
    }
}
