<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\TaClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classes::factory()
            ->count(10)
            ->create();
    }
}
