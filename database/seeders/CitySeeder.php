<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::insert([

            ['city_name' => 'Butuan', 'province_name' => 'Agusan del Norte'],
            ['city_name' => 'Tabaco', 'province_name' => 'Albay'],
            ['city_name' => 'Tagbilaran', 'province_name' => 'Bohol'],
            ['city_name' => 'Bataan', 'province_name' => 'Bataan'],
            ['city_name' => 'Batangas City', 'province_name' => 'Batangas'],
            ['city_name' => 'Tanauan', 'province_name' => 'Batangas'],
            ['city_name' => 'Valencia', 'province_name' => 'Bukidnon'],
            ['city_name' => 'Baguio', 'province_name' => 'Benguet'],
            ['city_name' => 'Roxas', 'province_name' => 'Capiz'],
            ['city_name' => 'Naga', 'province_name' => 'Camarines Sur'],
            ['city_name' => 'Tagaytay', 'province_name' => 'Cavite'],
            ['city_name' => 'Trece Martires', 'province_name' => 'Cavite'],
            ['city_name' => 'Tuguegarao', 'province_name' => 'Cagayan'],
            ['city_name' => 'Cebu City', 'province_name' => 'Cebu'],
            ['city_name' => 'Talisay', 'province_name' => 'Cebu'],
            ['city_name' => 'Toledo', 'province_name' => 'Cebu'],
            ['city_name' => 'Kidapawan', 'province_name' => 'Cotabato'],
            ['city_name' => 'Digos', 'province_name' => 'Davao del Sur'],
            ['city_name' => 'Davao City', 'province_name' => 'Davao del Sur'],
            ['city_name' => 'Panabo', 'province_name' => 'Davao del Norte'],
            ['city_name' => 'Samal', 'province_name' => 'Davao del Norte'],
            ['city_name' => 'Dumaguete', 'province_name' => 'Negros Oriental'],
            ['city_name' => 'Tanjay', 'province_name' => 'Negros Oriental'],
            ['city_name' => 'Bacolod', 'province_name' => 'Negros Occidental'],
            ['city_name' => 'San Carlos', 'province_name' => 'Negros Occidental'],
            ['city_name' => 'Sagay', 'province_name' => 'Negros Occidental'],
            ['city_name' => 'Victorias', 'province_name' => 'Negros Occidental'],
            ['city_name' => 'Iloilo City', 'province_name' => 'Iloilo'],
            ['city_name' => 'Ilagan', 'province_name' => 'Isabela'],
            ['city_name' => 'Tabuk', 'province_name' => 'Kalinga'],
            ['city_name' => 'San Fernando', 'province_name' => 'La Union'],
            ['city_name' => 'Baybay', 'province_name' => 'Leyte'],
            ['city_name' => 'Ormoc', 'province_name' => 'Leyte'],
            ['city_name' => 'Tacloban', 'province_name' => 'Leyte'],
            ['city_name' => 'Caloocan City', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Las Piñas', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Las Piñas City', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Makati', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Makati', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Malabon', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Mandaluyong', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Manila', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Marikina', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Muntinlupa', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Parañaque', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Pasay', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Pasig', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Quezon City', 'province_name' => 'Metro Manila'],
            ['city_name' => 'San Juan', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Taguig', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Valenzuela', 'province_name' => 'Metro Manila'],
            ['city_name' => 'Oroquieta', 'province_name' => 'Misamis Occidental'],
            ['city_name' => 'Tangub', 'province_name' => 'Misamis Occidental'],
            ['city_name' => 'Gingoog', 'province_name' => 'Misamis Oriental'],
            ['city_name' => 'Cabanatuan', 'province_name' => 'Nueva Ecija'],
            ['city_name' => 'Dagupan', 'province_name' => 'Pangasinan'],
            ['city_name' => 'Urdaneta', 'province_name' => 'Pangasinan'],
            ['city_name' => 'Lucena', 'province_name' => 'Quezon'],
            ['city_name' => 'Tayabas', 'province_name' => 'Quezon'],
            ['city_name' => 'Antipolo', 'province_name' => 'Rizal'],
            ['city_name' => 'Sorsogon City', 'province_name' => 'Sorsogon'],
            ['city_name' => 'General Santos', 'province_name' => 'South Cotabato'],
            ['city_name' => 'Koronadal', 'province_name' => 'South Cotabato'],
            ['city_name' => 'Tandag', 'province_name' => 'Surigao del Sur'],
            ['city_name' => 'Tarlac City', 'province_name' => 'Tarlac'],
            ['city_name' => 'Vigan', 'province_name' => 'Ilocos Sur'],
            ['city_name' => 'Zamboanga City', 'province_name' => 'Zamboanga del Sur'],
            ['city_name' => 'Zamboanga City', 'province_name' => 'Zamboanga del Sur']

        ]);
    }
}
