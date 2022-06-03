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
        $post = Role::query()->with('permissions')->first();
        /** @var User $user */
        $user = User::query()->create([
            'last_name' => "Admin",
            'first_name' => "Admin",
            'patronymic' => "Admin",
            'username' => 'admin',
            'password' => 'admin', // admin
            'post' => $post->id,
            'faculty_id' => 1,
            'department_id' => 1,
        ]);
        $user->assignRole($post->id);
    }
}
