<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title'       => fake()->jobTitle,
            'salary'      => fake()->numberBetween(10000, 100000),
            'location'    => fake()->randomElement(['Remote', fake()->city]),
            'schedule'    => fake()->randomElement(['Full Time', 'Part Time', 'Contract']),
            'featured'    => fake()->boolean,
            'url'         => fake()->url,
        ];
    }
}
