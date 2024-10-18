<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostChapter>
 */
class PostChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => fake()->numberBetween(1, 2),
            'title' => fake()->words(rand(1, 4), true),
            'number' => fake()->numberBetween(0, 100),
            'description' => fake()->text(),
            'published_at' => now(),
            'rate' => fake()->numberBetween(0, 10),
        ];
    }
}
