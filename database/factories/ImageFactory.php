<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_name' => $this->faker->randomElement(['movie', 'post', 'user']),
            'model_id' => $this->faker->numberBetween(1, 2),
            'path' => $this->faker->imageUrl(),
            'description' => $this->faker->sentence(),
            'imageable_id' => $this->faker->numberBetween(1, 100),
            'imageable_name' => $this->faker->word(),
        ];
    }
}
