<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
            'password' => Hash::make('admin'),
            'post' => Role::query()->first()->id,
        ])->assignRole(Role::query()->first()->id);

        User::factory(UserFactory::class)->count(500)->create();
    }
}
