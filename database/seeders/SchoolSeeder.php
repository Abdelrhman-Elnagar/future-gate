<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\EducationalAdministration;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        // Define secondary schools mapped to their respective educational administrations
        $schoolsByAdministration = [
            'Central Cairo Administration' => ['El Sayeda Zeinab Secondary School', 'Bab El-Louq Secondary School', 'Abdeen Language School'],
            'Nasr City Administration' => ['Nasr City Experimental School', 'El Mostakbal International School', 'Nasr City STEM School'],
            'Helwan Administration' => ['Helwan Secondary School', 'Wadi Hof School', 'Future Tech School'],
            'Maadi Administration' => ['Maadi Secondary School', 'British International School Maadi', 'Maadi STEM Academy'],

            'Dokki Administration' => ['Dokki Experimental School', 'Orman Secondary School', 'Giza Language School'],
            '6th of October Administration' => ['6th of October Secondary School', 'Pioneers International School', 'October STEM School'],
            'Haram Administration' => ['El Haram Secondary School', 'Al-Omraneya School', 'Haram Modern School'],
            'Imbaba Administration' => ['Imbaba Secondary School', 'Imbaba STEM School', 'Al-Fajr Secondary School'],

            'East Alexandria Administration' => ['Sidi Gaber Secondary School', 'El-Nahda Language School', 'Future School Alexandria'],
            'West Alexandria Administration' => ['Al-Manshiya Secondary School', 'Agami Language School', 'Alexandria STEM School'],
            'Montaza Administration' => ['Montaza Secondary School', 'El-Maamoura Experimental School', 'Montaza STEM Academy'],
            'Amreya Administration' => ['Amreya Secondary School', 'Borg El-Arab STEM School', 'Amreya Language School'],

            'Mansoura Administration' => ['Mansoura Secondary School', 'Delta International School', 'Mansoura STEM School'],
            'Talkha Administration' => ['Talkha Language School', 'Talkha Experimental School'],
            'Mit Ghamr Administration' => ['Mit Ghamr Secondary School', 'Mit Ghamr STEM Academy'],
            'Sherbin Administration' => ['Sherbin Secondary School', 'Sherbin Experimental School'],

            'Hurghada Administration' => ['Hurghada Secondary School', 'Red Sea International School'],
            'Safaga Administration' => ['Safaga Secondary School', 'Safaga Language School'],
            'Marsa Alam Administration' => ['Marsa Alam STEM School', 'Marsa Alam Secondary School'],
            'Quseir Administration' => ['Quseir Secondary School', 'Quseir Experimental Language School'],

            'Damanhour Administration' => ['Damanhour Secondary School', 'Damanhour STEM Academy'],
            'Kafr El-Dawar Administration' => ['Kafr El-Dawar Secondary School', 'Kafr El-Dawar Language School'],
            'Rashid Administration' => ['Rashid Experimental School', 'Rashid Secondary School'],
            'Abu Hummus Administration' => ['Abu Hummus Secondary School', 'Abu Hummus STEM School'],

            'Beni Suef City Administration' => ['Beni Suef Secondary School', 'Future International School Beni Suef'],
            'Nasser Administration' => ['Nasser Language School', 'Nasser STEM School'],
            'Al-Fashn Administration' => ['Al-Fashn Secondary School', 'Al-Fashn Experimental School'],
            'Biba Administration' => ['Biba Secondary School', 'Biba STEM Academy'],

            'Ismailia City Administration' => ['Ismailia Experimental School', 'El Salam Secondary School', 'Suez Canal STEM School'],
            'Fayed Administration' => ['Fayed Language School', 'Fayed STEM School'],
            'Qantara Administration' => ['Qantara Secondary School', 'Qantara Experimental School'],
            'Tell El Kebir Administration' => ['Tell El Kebir STEM School', 'Tell El Kebir Secondary School'],

            'Banha Administration' => ['Banha Secondary School', 'Banha Experimental Language School'],
            'Shubra El-Kheima Administration' => ['Shubra El-Kheima Secondary School', 'Shubra STEM Academy'],
            'Qalyub Administration' => ['Qalyub Secondary School', 'Qalyub STEM School'],
            'Khanka Administration' => ['Khanka Secondary School', 'Khanka Experimental Language School'],

            'Zagazig Administration' => ['Zagazig Secondary School', 'El Nile Experimental School', 'Al-Orman School Zagazig'],
            'Belbeis Administration' => ['Belbeis Secondary School', 'Belbeis Experimental Language School'],
            'Minya Al-Qamh Administration' => ['Minya Al-Qamh Secondary School', 'Minya STEM Academy'],
            'Hihya Administration' => ['Hihya Secondary School', 'Hihya Experimental Language School'],

            'Suez City Administration' => ['Suez Experimental School', 'Future International School Suez'],
            'Al-Arbaeen Administration' => ['Al-Arbaeen Secondary School', 'Al-Arbaeen STEM Academy'],
            'Ataka Administration' => ['Ataka Language School', 'Ataka Secondary School'],
            'El-Ganayen Administration' => ['El-Ganayen Experimental School', 'El-Ganayen STEM School'],

            'Luxor City Administration' => ['Luxor Secondary School', 'New Luxor International School'],
            'Armant Administration' => ['Armant Secondary School', 'Armant STEM Academy'],
            'Esna Administration' => ['Esna Secondary School', 'Esna Experimental School'],
            'Al-Tod Administration' => ['Al-Tod Secondary School', 'Al-Tod STEM Academy'],

            'Qena City Administration' => ['Qena Secondary School', 'Qena STEM School'],
            'Nag Hammadi Administration' => ['Nag Hammadi Secondary School', 'Nag Hammadi STEM Academy'],
            'Dishna Administration' => ['Dishna Secondary School', 'Dishna Experimental Language School'],
            'Qus Administration' => ['Qus Secondary School', 'Qus STEM Academy'],

            'Arish Administration' => ['Arish Secondary School', 'North Sinai International School'],
            'Sheikh Zuweid Administration' => ['Sheikh Zuweid Secondary School', 'Sheikh Zuweid STEM Academy'],
            'Bir El-Abd Administration' => ['Bir El-Abd Secondary School', 'Bir El-Abd Experimental School'],
            'Rafah Administration' => ['Rafah Secondary School', 'Rafah STEM Academy'],

            'Sohag City Administration' => ['Sohag Secondary School', 'Sohag STEM Academy'],
            'Tahta Administration' => ['Tahta Secondary School', 'Tahta Experimental Language School'],
            'Girga Administration' => ['Girga Secondary School', 'Girga STEM School'],
            'Akhmim Administration' => ['Akhmim Secondary School', 'Akhmim Experimental School'],
        ];

        // Fetch all educational administrations
        $educationalAdministrations = EducationalAdministration::all();

        foreach ($educationalAdministrations as $administration) {
            // Get corresponding schools or provide a default
            $schools = $schoolsByAdministration[$administration->name] ?? ["{$administration->name} Secondary School"];

            foreach ($schools as $school) {
                School::create([
                    'name' => $school,
                    'educational_administration_id' => $administration->id,
                ]);
            }
        }
    }
}
