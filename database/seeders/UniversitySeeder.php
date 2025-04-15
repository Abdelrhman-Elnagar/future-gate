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
                'location' => 'https://maps.app.goo.gl/cnVasrdnACkkDzqx7',
                'logo' => 'logos/cairo_university.png',
                'pic' => 'uni/u/2.jpeg',
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
                'location' => 'https://maps.app.goo.gl/3ufmi5PZ3AXcT3p7A',
                'logo' => 'logos/ain_shams.png',
                'pic' => 'uni/u/10.jpeg',
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
                'location' => 'https://maps.app.goo.gl/N5Hpej6Uo5ZKFfT96',
                'logo' => 'logos/alexandria_university.png',
                'pic' => 'uni/u/3.jpeg',
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
                'location' => 'https://maps.app.goo.gl/hvdMagv48a5tnYq39',
                'logo' => 'logos/assiut_university.png',
                'pic' => 'uni/u/4.jpeg',
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
                'location' => 'https://maps.app.goo.gl/gvZiD7bp1ttRVmkAA',
                'logo' => 'logos/mansoura_university.png',
                'pic' => 'uni/u/1.jpeg',
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
                'location' => 'https://maps.app.goo.gl/D7NXqQcZbAnt6qPV6',
                'logo' => 'logos/zagazig_university.png',
                'pic' => 'uni/u/9.jpeg',
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
                'location' => 'https://maps.app.goo.gl/xC4skCcM9ALr3jxN6', 
                'logo' => 'logos/helwan_university.png',
                'pic' => 'uni/u/5.jpeg',
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
                'location' => 'https://maps.app.goo.gl/GkBqXL5TugYb26fd9',
                'logo' => 'logos/minia_university.png',
                'pic' => 'uni/u/6.jpeg',
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
                'location' => 'https://maps.app.goo.gl/ZcMejgWH5DAXvHvcA',
                'logo' => 'logos/suez_canal_university.png',
                'pic' => 'uni/u/7.jpeg',
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
                'location' => 'https://maps.app.goo.gl/aREy2rq7Ad6H4sNG7',
                'logo' => 'logos/tanta_university.png',
                'pic' => 'uni/u/8.jpeg',
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
