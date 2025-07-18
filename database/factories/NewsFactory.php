<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = ['pict1.jpeg', 'pict2.jpeg', 'pict3.jpeg', 'pict4.jpeg', 'pict5.jpeg', 'pict6.jpeg'];

        return [
            'title' => fake()->sentence(4),
            'content' => fake()->text(1000),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'image' => 'img/' . fake()->randomElement($images),
            'created_at' => fake()->dateTime(),
            'views' => fake()->numberBetween(0, 1000),
            'status' => fake()->randomElement(['Accept', 'Pending', 'Reject']),
        ];
    }
}
