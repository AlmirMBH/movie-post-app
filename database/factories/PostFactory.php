<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(2, true),
            'subtitle' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'body' => $this->faker->text(),
            'author_id' => 1,
            // 'category_id' => random_int(1, 5),
            // 'slug' => $this->faker->slug(),
            'movie_id' => random_int(1, 20)
        ];
        
    }
}
