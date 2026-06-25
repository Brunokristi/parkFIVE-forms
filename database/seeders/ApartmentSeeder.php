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
                'name' => 'Apartmán 1 (na prízemí)',
                'address' => 'Parková 5, 984 01 Lučenec, Slovensko',
                'checkin_time' => 'od 15:00',
                'access_code' => '000011',
                'wifi_name' => 'apartman1',
                'wifi_password' => 'parkfive1',
                'parking_info' => 'Bezplatné parkovanie je dostupné na ulici pred budovou.',                
                'pool_info' => 'Bazén nie je automaticky zahrnutý v rezervácii. Pri objednaní pred príchodom ho môžete získať za zvýhodnenú cenu 20 € / deň namiesto bežnej ceny 30 € / deň.',
                'contact_info' => 'Prosím kontaktujte nás cez správy booking.com',
            ],
            [
                'slug' => 'apartman-2',
                'name' => 'Apartmán 2 (na poschodí)',
                'address' => 'Parková 5, 984 01 Lučenec, Slovensko',
                'checkin_time' => 'od 15:00',
                'access_code' => '0011',
                'wifi_name' => 'apartman2',
                'wifi_password' => 'parkfive2',
                'parking_info' => 'Bezplatné parkovanie je dostupné na ulici pred budovou.',
                'pool_info' => 'Bazén nie je automaticky zahrnutý v rezervácii. Pri objednaní pred príchodom ho môžete získať za zvýhodnenú cenu 20 € / deň namiesto bežnej ceny 30 € / deň.',
                'contact_info' => 'Prosím kontaktujte nás cez správy booking.com',
            ],
        ];

        foreach ($apartments as $data) {
            Apartment::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}