<?php

namespace Database\Seeders;

use App\Models\TaClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaClass::factory()
            ->count(10)
            ->create();
    }
}
