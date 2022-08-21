<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'manufacturer' => $this->faker->company(),
            'cost' => $this->faker->randomFloat(min: 99, max: 9999),
            'release_date' => $this->faker->dateTimeInInterval('- 3 years', '- 31 days'),
        ];
    }
}
