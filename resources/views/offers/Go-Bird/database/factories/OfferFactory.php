<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()-> sentence(),
            'country' => fake()-> country(),
            'city' => fake()->city(),
            'address' => fake()->sentence(),
            'description' => fake() -> paragraph(),
            'price' => fake()-> numberBetween(20, 1500),
            'region' => $this->faker->randomElement(['Africa', 'Middle East', 'Europe', 'Americas', 'Asia Pacific']),
            'category' => $this->faker->randomElement(['Beach', 'Seaside', 'Countryside', 'Mountain', 'Lake', 'Luxe', 'Traditional', 'Farm', 'Island', 'Camping', 'Boats', 'Houseboats', 'Desert', 'Ski resort']),
            'type' => $this->faker->randomElement(['House', 'Apartment', 'Hotel', 'Guesthouse']),
            'photo' => $this->faker->imageUrl($width = 200, $height = 200),
        ];
    }
}
