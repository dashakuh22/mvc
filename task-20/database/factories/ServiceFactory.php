<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cost' => $this->faker->randomFloat(min: 9, max: 199),
            'deadline' => $this->faker->dateTimeInInterval('+ 3 days', '+ 31 days'),
        ];
    }
}
