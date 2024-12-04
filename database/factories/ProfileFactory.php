<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "phone_number" => fake()->phoneNumber(),
            "job" => fake()->jobTitle(),
            "image" => fake()->imageUrl(),
            "country" => fake()->country(),
            "user_id" => User::factory()
        ];
    }
}
