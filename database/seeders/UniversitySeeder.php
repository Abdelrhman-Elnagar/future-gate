<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University; // Assuming you have a University model
use Illuminate\Support\Facades\DB;


class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records
        // DB::table('universities')->truncate();

        $universities = [
            [
                'name' => 'جامعة القاهرة',
                'website' => 'https://cu.edu.eg',
                'location' => 'https://goo.gl/maps/4S5Ma7o5umr5c3FG7',
                'logo' => 'logos/cairo_university.png',
                'description' => 'إحدى أقدم وأعرق الجامعات في مصر، تأسست عام 1908.',
                'established_year' => 1908,
                'email' => 'info@cu.edu.eg',
                'phone' => '+20235676100',
                'address' => 'الجيزة، مصر',
                'ranking' => 1,
            ],
            [
                'name' => 'جامعة عين شمس',
                'website' => 'https://www.asu.edu.eg',
                'location' => 'https://goo.gl/maps/1zG7e4o5umr5c3FG7',
                'logo' => 'logos/ain_shams.png',
                'description' => 'جامعة رائدة في مصر، تأسست عام 1950.',
                'established_year' => 1950,
                'email' => 'info@asu.edu.eg',
                'phone' => '+20226834222',
                'address' => 'القاهرة، مصر',
                'ranking' => 2,
            ],
            [
                'name' => 'جامعة الإسكندرية',
                'website' => 'https://alexu.edu.eg',
                'location' => 'https://goo.gl/maps/2yT8e5o6umr5c3FG7',
                'logo' => 'logos/alexandria_university.png',
                'description' => 'جامعة كبرى في مدينة الإسكندرية، تأسست عام 1938.',
                'established_year' => 1938,
                'email' => 'info@alexu.edu.eg',
                'phone' => '+2035921678',
                'address' => 'الإسكندرية، مصر',
                'ranking' => 3,
            ],
            [
                'name' => 'جامعة أسيوط',
                'website' => 'https://www.aun.edu.eg',
                'location' => 'https://goo.gl/maps/3zU9f6o7umr5c3FG7',
                'logo' => 'logos/assiut_university.png',
                'description' => 'جامعة بارزة في صعيد مصر، تأسست عام 1957.',
                'established_year' => 1957,
                'email' => 'info@aun.edu.eg',
                'phone' => '+20882323200',
                'address' => 'أسيوط، مصر',
                'ranking' => 4,
            ],
            [
                'name' => 'جامعة المنصورة',
                'website' => 'https://www.mans.edu.eg',
                'location' => 'https://goo.gl/maps/4aV0g7o8umr5c3FG7',
                'logo' => 'logos/mansoura_university.png',
                'description' => 'جامعة رائدة في دلتا النيل، تأسست عام 1972.',
                'established_year' => 1972,
                'email' => 'info@mans.edu.eg',
                'phone' => '+20502203833',
                'address' => 'المنصورة، مصر',
                'ranking' => 5,
            ],
            [
                'name' => 'جامعة الزقازيق',
                'website' => 'https://www.zu.edu.eg',
                'location' => 'https://goo.gl/maps/5bW1h8o9umr5c3FG7',
                'logo' => 'logos/zagazig_university.png',
                'description' => 'جامعة كبرى بمحافظة الشرقية، تأسست عام 1974.',
                'established_year' => 1974,
                'email' => 'info@zu.edu.eg',
                'phone' => '+20552230444',
                'address' => 'الزقازيق، مصر',
                'ranking' => 6,
            ],
            [
                'name' => 'جامعة حلوان',
                'website' => 'https://www.helwan.edu.eg',
                'location' => 'https://goo.gl/maps/6cX2i9p0umr5c3FG7',
                'logo' => 'logos/helwan_university.png',
                'description' => 'جامعة حكومية في مدينة حلوان، تأسست عام 1975.',
                'established_year' => 1975,
                'email' => 'info@helwan.edu.eg',
                'phone' => '+20225580000',
                'address' => 'حلوان، مصر',
                'ranking' => 7,
            ],
            [
                'name' => 'جامعة المنيا',
                'website' => 'https://www.minia.edu.eg',
                'location' => 'https://goo.gl/maps/7dY3j0q1umr5c3FG7',
                'logo' => 'logos/minia_university.png',
                'description' => 'جامعة في محافظة المنيا، تأسست عام 1976.',
                'established_year' => 1976,
                'email' => 'info@minia.edu.eg',
                'phone' => '+20862332000',
                'address' => 'المنيا، مصر',
                'ranking' => 8,
            ],
            [
                'name' => 'جامعة قناة السويس',
                'website' => 'https://www.suez.edu.eg',
                'location' => 'https://goo.gl/maps/8eZ4k1r2umr5c3FG7',
                'logo' => 'logos/suez_canal_university.png',
                'description' => 'جامعة تقع بالقرب من قناة السويس، تأسست عام 1976.',
                'established_year' => 1976,
                'email' => 'info@suez.edu.eg',
                'phone' => '+20643220000',
                'address' => 'الإسماعيلية، مصر',
                'ranking' => 9,
            ],
            [
                'name' => 'جامعة طنطا',
                'website' => 'https://www.tanta.edu.eg',
                'location' => 'https://goo.gl/maps/9fA5l2s3umr5c3FG7',
                'logo' => 'logos/tanta_university.png',
                'description' => 'جامعة في مدينة طنطا، تأسست عام 1972.',
                'established_year' => 1972,
                'email' => 'info@tanta.edu.eg',
                'phone' => '+20403310000',
                'address' => 'طنطا، مصر',
                'ranking' => 10,
            ],
        ];



        foreach ($universities as $university) {
            University::create($university);
        }
    }
}
