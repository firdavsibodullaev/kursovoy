<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;
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
        $faculty = Faculty::query()->inRandomOrder()->first();
        $department = Department::query()->where('faculty_id', '=', $faculty->id)->inRandomOrder()->first();
        return [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'patronymic' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'faculty_id' => $faculty->id,
            'department_id' => $department->id,
            'password' => 'admin', // admin
            'post' => Role::query()->inRandomOrder()->firstWhere('id', '!=', 1)->id,
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
