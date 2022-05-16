<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->insert([
            ['name' => 'Админ', 'guard_name' => 'web'],
            ['name' => 'Ректор', 'guard_name' => 'web'],
            ['name' => 'Проректор', 'guard_name' => 'web'],
            ['name' => 'Декан', 'guard_name' => 'web'],
            ['name' => 'Зав. кафедра', 'guard_name' => 'web'],
            ['name' => 'Учитель', 'guard_name' => 'web'],
        ]);

        /** @var Role $role */
        $role = Role::query()->first();

        $permission = Permission::query()->create(['name' => 'Создать данные', 'guard_name' => 'web']);

        $role->givePermissionTo($permission);
    }
}
