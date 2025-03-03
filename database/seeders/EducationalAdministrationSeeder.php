<?php

namespace Database\Seeders;


use App\Models\EducationalAdministration;
use App\Models\Governate;
use Illuminate\Database\Seeder;

class EducationalAdministrationSeeder extends Seeder
{
    public function run(): void
    {
        // Define realistic educational administrations for each governate
        $educationalAdministrations = [
            'Cairo' => ['Central Cairo Administration', 'Nasr City Administration', 'Helwan Administration', 'Maadi Administration'],
            'Giza' => ['Dokki Administration', '6th of October Administration', 'Haram Administration', 'Imbaba Administration'],
            'Alexandria' => ['East Alexandria Administration', 'West Alexandria Administration', 'Montaza Administration', 'Amreya Administration'],
            'Dakahlia' => ['Mansoura Administration', 'Talkha Administration', 'Mit Ghamr Administration', 'Sherbin Administration'],
            'Red Sea' => ['Hurghada Administration', 'Safaga Administration', 'Marsa Alam Administration', 'Quseir Administration'],
            'Beheira' => ['Damanhour Administration', 'Kafr El-Dawar Administration', 'Rashid Administration', 'Abu Hummus Administration'],
            'Fayoum' => ['Fayoum City Administration', 'Ibsheway Administration', 'Sinnuris Administration', 'Tamiya Administration'],
            'Gharbia' => ['Tanta Administration', 'El-Mahalla Administration', 'Kafr El-Zayat Administration', 'Zefta Administration'],
            'Ismailia' => ['Ismailia City Administration', 'Fayed Administration', 'Qantara Administration', 'Tell El Kebir Administration'],
            'Menoufia' => ['Shebin El-Kom Administration', 'Ashmoun Administration', 'Tala Administration', 'Menouf Administration'],
            'Minya' => ['Minya City Administration', 'Beni Mazar Administration', 'Samalut Administration', 'Mallawi Administration'],
            'Qalyubia' => ['Banha Administration', 'Shubra El-Kheima Administration', 'Qalyub Administration', 'Khanka Administration'],
            'New Valley' => ['Kharga Administration', 'Dakhla Administration', 'Farafra Administration', 'Paris Administration'],
            'Suez' => ['Suez City Administration', 'Al-Arbaeen Administration', 'Ataka Administration', 'El-Ganayen Administration'],
            'Aswan' => ['Aswan City Administration', 'Edfu Administration', 'Kom Ombo Administration', 'Daraw Administration'],
            'Assiut' => ['Assiut City Administration', 'Dairut Administration', 'Al-Quseyya Administration', 'Manfalut Administration'],
            'Beni Suef' => ['Beni Suef City Administration', 'Nasser Administration', 'Al-Fashn Administration', 'Biba Administration'],
            'Port Said' => ['Port Fouad Administration', 'El-Zohour Administration', 'Al-Manakh Administration', 'Al-Dawahi Administration'],
            'Damietta' => ['Damietta City Administration', 'Faraskur Administration', 'Zarqa Administration', 'Kafr Saad Administration'],
            'South Sinai' => ['Sharm El-Sheikh Administration', 'Dahab Administration', 'El-Tor Administration', 'Nuweiba Administration'],
            'Kafr El Sheikh' => ['Kafr El Sheikh City Administration', 'Desouk Administration', 'Baltim Administration', 'Sidi Salem Administration'],
            'Matrouh' => ['Marsa Matrouh Administration', 'Siwa Administration', 'Alamein Administration', 'Dabaa Administration'],
            'Luxor' => ['Luxor City Administration', 'Armant Administration', 'Esna Administration', 'Al-Tod Administration'],
            'Qena' => ['Qena City Administration', 'Nag Hammadi Administration', 'Dishna Administration', 'Qus Administration'],
            'North Sinai' => ['Arish Administration', 'Sheikh Zuweid Administration', 'Bir El-Abd Administration', 'Rafah Administration'],
            'Sohag' => ['Sohag City Administration', 'Tahta Administration', 'Girga Administration', 'Akhmim Administration'],
            'Sharqia' => ['Zagazig Administration', 'Belbeis Administration', 'Minya Al-Qamh Administration', 'Hihya Administration'],
        ];

        // Loop through all governates and seed educational administrations
        $governates = Governate::all();

        foreach ($governates as $governate) {
            // Get corresponding educational administrations or default to a generic one
            $administrations = $educationalAdministrations[$governate->name] ?? ["{$governate->name} Educational Administration"];

            foreach ($administrations as $administration) {
                EducationalAdministration::create([
                    'name' => $administration,
                    'governate_id' => $governate->id,
                ]);
            }
        }
    }
}
