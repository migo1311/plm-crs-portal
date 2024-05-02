<?php

namespace Database\Factories;

use App\Models\Aysem;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Block>
 */
class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Block::class;

    public function definition(): array
    {
        $programid = \App\Models\Program::all()->random()->program_id;
        $aysemid = \App\Models\Aysem::all()->random()->aysem_id;
        $blockid = $aysemid . $this->faker->unique(true)->randomNumber(6, true);
        
        $yearLevel = $this->faker->unique(true)->numberBetween(1, 5);
        $section = $this->faker->unique(true)->numberBetween(1, 4);

        $blockCode = Program::query()
                    ->where('program_id','=',$programid)
                    ->value('program_code') . ' ' . $yearLevel . '-' . $section;
        $blockName = $blockCode . ' (' . $blockid . ')';
        $slots = $this->faker->numberBetween(30, 50);

        return [
            'block_id' => $blockid,
            'year_level' => $yearLevel,
            'section' => $section,
            'program_id' => $programid,
            'aysem_id' => $aysemid,
            'block_name' => $blockName,
            'block_code' => $blockCode,
            'slots' => $slots,
        ];
    }
}
