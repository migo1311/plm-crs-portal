<?php

namespace Database\Factories;

use App\Models\Aysem;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Course::class;

    public function definition(): array
    {
        $title = $this->faker->randomElement(['Introduction to Computer Science', 'Computer Programming', 'Data Structures and Algorithms', 'Discrete Mathematics', 'Computer Organization and Architecture', 'Operating Systems', 'Database Management Systems', 'Software Engineering', 'Web Development', 'Mobile Development', 'Computer Networks', 'Artificial Intelligence', 'Machine Learning', 'Computer Vision', 'Robotics', 'Cybersecurity', 'Computer Graphics', 'Game Development', 'Human-Computer Interaction', 'Computer Ethics']);

        $code = $this->faker->unique()->randomElement(['CS 11', 'CS 12', 'CS 13', 'CS 14', 'CS 15', 'CS 16', 'CS 17', 'CS 18', 'CS 19', 'CS 20', 'CS 11.1', 'CS 12.1', 'CS 13.1', 'CS 14.1', 'CS 15.1', 'CS 16.1', 'CS 17.1', 'CS 18.1', 'CS 19.1', 'CS 20.1']);

        return [
            'subject_code' => $code,
            'subject_title' => $title,
            'course_number' => $code . ' - ' . $title,
            'units' => $this->faker->unique(true)->numberBetween(1, 4),
            'class_code' => $this->faker->unique(true)->randomNumber(5, true),
            'aysem_id' => Aysem::all()->random()->aysem_id,
        ];
    }
}
