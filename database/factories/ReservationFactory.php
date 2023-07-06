<?php

namespace Database\Factories;

use App\Models\Host;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $offerIds = Offer::pluck('id')->toArray();
        $userIds = User::whereNotIn('id', Host::pluck('user_id')->toArray())->pluck('id')->toArray();

        return [
            'offer_id' => $this->faker->randomElement($offerIds),
            'user_id' => $this->faker->randomElement($userIds),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'status' => $this->faker->randomElement(['pending','accepted','declined']),
        ];
    }
}
