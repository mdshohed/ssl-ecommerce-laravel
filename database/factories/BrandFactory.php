<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\brands>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brandName'=> $this->faker->name,
            'brandImg'=> $this->faker->imageUrl(360, 360, 'animals', true, 'dogs', true, 'jpg'),
        ];
    }
}
