<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'body' => $this->faker->paragraph,
            'image_id' => $this->faker->numberBetween(1, 10),
            'director' => $this->faker->name,
            'slug' => $this->faker->unique()->slug,
            'added_by_id' => $this->faker->numberBetween(1, 20),
        ];        
    }
}
