<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\TaClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlockClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blocks = Block::all();
        $classes = TaClass::all();

        foreach ($blocks as $block) {
            // Randomly select classes to associate with the current block
            $classIds = $classes->random(rand(5, 9))->pluck('class_id');
            
            // Attach the selected classes to the current block
            $block->classes()->attach($classIds);
        }
    }
}
