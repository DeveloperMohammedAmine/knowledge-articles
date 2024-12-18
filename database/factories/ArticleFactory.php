<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => fake()->sentence(),
            "text" => implode("\n", fake()->paragraphs(5)),
            "image" => fake()->imageUrl(),
            "user_id" => User::all()->random()->id,
            "category_id" => Category::all()->random()->id,
        ];
    }
}
