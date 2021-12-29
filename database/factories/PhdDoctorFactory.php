<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhdDoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'diploma' => [
                'series' => $this->faker->randomDigit(),
                'number' => $this->faker->randomNumber(8, true)
            ],
            'speciality_name' => $this->faker->sentence,
            'employment' => [
                'order' => $this->faker->word,
                'date' => $this->faker->date
            ],
            'user' => [
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'patronymic' => $this->faker->word,
            ]
        ];
    }
}
