<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'patronymic' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'password' => '$2y$10$oLd1E7wid6Nqb/mfujvxVu.SMnri6L9ATR2C3kaXNVKdihEZ77Qxy', // admin
            'post' => Role::query()->inRandomOrder()->firstWhere('id','!=', 1)->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
