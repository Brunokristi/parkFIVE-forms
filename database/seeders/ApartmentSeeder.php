<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        $apartments = [
            [
                'slug' => 'apartman-1',
                'name' => 'Apartmán 1',
                'address' => 'DOPLNIŤ ADRESU',
                'checkin_time' => 'od 15:00',
                'access_code' => 'DOPLNIŤ KÓD',
                'wifi_name' => 'DOPLNIŤ WIFI',
                'wifi_password' => 'DOPLNIŤ HESLO',
                'parking_info' => 'DOPLNIŤ PARKOVANIE',
                'pool_info' => 'Bazén nie je automaticky zahrnutý v rezervácii. Pri objednaní pred príchodom ho môžete získať za zvýhodnenú cenu 20 € / deň namiesto bežnej ceny 30 € / deň.',
                'contact_info' => 'DOPLNIŤ KONTAKT',
            ],
            [
                'slug' => 'apartman-2',
                'name' => 'Apartmán 2',
                'address' => 'DOPLNIŤ ADRESU',
                'checkin_time' => 'od 15:00',
                'access_code' => 'DOPLNIŤ KÓD',
                'wifi_name' => 'DOPLNIŤ WIFI',
                'wifi_password' => 'DOPLNIŤ HESLO',
                'parking_info' => 'DOPLNIŤ PARKOVANIE',
                'pool_info' => 'Bazén nie je automaticky zahrnutý v rezervácii. Pri objednaní pred príchodom ho môžete získať za zvýhodnenú cenu 20 € / deň namiesto bežnej ceny 30 € / deň.',
                'contact_info' => 'DOPLNIŤ KONTAKT',
            ],
        ];

        foreach ($apartments as $data) {
            Apartment::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}