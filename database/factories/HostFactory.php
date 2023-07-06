<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Host>
 */
class HostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'agree_to_host_terms' => $this->faker->randomElement([true, false]),
            'account_approved' => $this->faker->randomElement([true, false]),
            'user_id' => User::pluck('id')->random(),
        ];
    }
}
