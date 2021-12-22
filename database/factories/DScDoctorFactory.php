<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DScDoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'diploma' => json_encode([
                'series' => $this->faker->randomDigit(),
                'number' => $this->faker->randomNumber(8, true)
            ]),
            'speciality_name' => $this->faker->sentence,
            'employment' => json_encode([
                'order' => $this->faker->word,
                'date' => $this->faker->date
            ]),
            'user_id' => $this->faker->unique()->numberBetween(2, 200)
        ];
    }
}
