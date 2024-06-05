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
        $programid = Program::all()->random()->id;
        $aysemid = Aysem::all()->last()->id;
        $blockid = intval($aysemid . $this->faker->unique(true)->randomNumber(6, true));
        
        $yearLevel = $this->faker->unique(true)->numberBetween(1, 5);
        $section = $this->faker->unique(true)->numberBetween(1, 4);

        return [
            'id' => $blockid,
            'year_level' => $yearLevel,
            'section' => $section,
            'program_id' => $programid,
            'aysem_id' => $aysemid,
        ];
    }
}
