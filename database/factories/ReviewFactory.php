<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->paragraph(),
            'overall_rating' => $this->faker->numberBetween(1, 5),
            'cleanliness_rating' => $this->faker->numberBetween(1, 5),
            'accuracy_rating' => $this->faker->numberBetween(1, 5),
            'communication_rating' => $this->faker->numberBetween(1, 5),
            'check_in_rating' => $this->faker->numberBetween(1, 5),
            'location_rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
