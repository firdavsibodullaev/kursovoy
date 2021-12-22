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
            'username' => $this->faker->unique ()->userName,
            'password' => Hash::make('admin'),
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
