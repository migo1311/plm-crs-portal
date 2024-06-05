<?php

namespace Database\Seeders;

use App\Models\FeeStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeeStatus::insert([
            ['fee_status' => 'Fully Paid'],
            ['fee_status' => 'Partial Paid'],
            ['fee_status' => 'Not Paid'],
        ]);
    }
}
