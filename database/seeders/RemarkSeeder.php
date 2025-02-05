<?php

namespace Database\Seeders;

use App\Models\Remark;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RemarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Remark::insert([
            [
                'remark' => 'Passed'
            ],
            [
                'remark' => 'Failed'
            ],
            [
                'remark' => 'Incomplete'
            ],
            [
                'remark' => 'Dropped'
            ],
        ]);
    }
}
