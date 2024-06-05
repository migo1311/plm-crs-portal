<?php

namespace Database\Seeders;

use App\Models\ClassMode;
use App\Models\Mode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassMode::insert([
            [
                'mode_code' => 'LEC',
                'mode_type' => 'Lecture'
            ],
            [
                'mode_code' => 'LAB',
                'mode_type' => 'Laboratory'
            ],
            [
                'mode_code' => 'F2F',
                'mode_type' => 'Face-to-Face'
            ],
            [
                'mode_code' => 'LEC-SYNC',
                'mode_type' => 'Lecture-Synchronous-Online'
            ],
            [
                'mode_code' => 'LAB-SYNC',
                'mode_type' => 'Laboratory-Synchronous-Online'
            ],
            [
                'mode_code' => 'LEC-ASYNC',
                'mode_type' => 'Lecture-Asynchronous'
            ],
            [
                'mode_code' => 'LAB-ASYNC',
                'mode_type' => 'Laboratory-Asynchronous'
            ],
            [
                'mode_code' => 'LEC-SYNC-ASYNCH',
                'mode_type' => 'Lecture-Synchronous/Asynchronous'
            ],
            [
                'mode_code' => 'SKILL-LAB',
                'mode_type' => 'Skills Laboratory'
            ],
            [
                'mode_code' => 'BLENDED',
                'mode_type' => 'Blended'
            ],
        ]);
    }
}
