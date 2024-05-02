<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Building::insert([
            [
                'building_code' => 'GA',
                'building_name' => 'Gusaling Atienza'
            ],
            [
                'building_code' => 'GB',
                'building_name' => 'Gusaling Bagatsing'
            ],
            [
                'building_code' => 'GCA',
                'building_name' => 'Gusaling Corazon Aquino'
            ],
            [
                'building_code' => 'GEE',
                'building_name' => 'Gusaling Emilio Ejercito'    
            ],
            [
                'building_code' => 'GK',
                'building_name' => 'Gusaling Katipunan'
            ],
            [
                'building_code' => 'GL',
                'building_name' => 'Gusaling Lacson'
            ],
            [
                'building_code' => 'GV',
                'building_name' => 'Gusaling Villegas'
            ],
            [
                'building_code' => 'JAA',
                'building_name' => 'Justo Albert Auditorium'
            ],
            [
                'building_code' => 'KOC',
                'building_name' => 'Knight of Columbus'
            ],
            [
                'building_code' => 'TB',
                'building_name' => 'Tanghalang Bayan'
            ],
            [
                'building_code' => 'UAC',
                'building_name' => 'University Activity Center'
            ],
            [
                'building_code' => 'GYMN',
                'building_name' => 'University Gymnasium'
            ]
        ]);
    }
}
