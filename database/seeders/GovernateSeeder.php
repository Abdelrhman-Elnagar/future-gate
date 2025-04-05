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
            'القاهرة',
            'الجيزة',
            'الإسكندرية',
            'البحيرة',
            'الفيوم',
            'الغربية',
            'الإسماعيلية',
            'المنوفية',
            'المنيا',
            'القليوبية',
            'الوادى الجديد',
            'السويس',
            'أسوان',
            'أسيوط',
            'بنى سويف',
            'بور سعيد',
            'دمياط',
            'جنوب سيناء',
            'كفر الشيخ',
            'مطروح',
            'الأقصر',
            'قنا',
            'شمال سيناء',
            'سوهاج',
            'الشرقية'
        ];

        foreach ($governates as $governate) {
            Governate::create(['name' => $governate]);
        }
    }

}
