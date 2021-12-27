<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'last_name' => "Admin",
            'first_name' => "Admin",
            'patronymic' => "Admin",
            'username' => 'admin',
            'password' => '$2y$10$oLd1E7wid6Nqb/mfujvxVu.SMnri6L9ATR2C3kaXNVKdihEZ77Qxy', // admin
            'post' => Role::query()->first()->id,
        ])->assignRole(Role::query()->first()->id);

        User::factory(UserFactory::class)->count(500)->create();
    }
}
