<?php

namespace Database\Seeders;

use App\Models\BiologicalSex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiologicalSexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BiologicalSex::insert([
            ['sex' => 'Male'],
            ['sex' => 'Female'],
            ]);
    }
}
