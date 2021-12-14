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
            ['name' => 'Админ', 'guard_name' => 'api'],
            ['name' => 'Ректор', 'guard_name' => 'api'],
            ['name' => 'Проректор', 'guard_name' => 'api'],
            ['name' => 'Декан', 'guard_name' => 'api'],
            ['name' => 'Зав. кафедра', 'guard_name' => 'api'],
            ['name' => 'Учитель', 'guard_name' => 'api'],
        ]);

        /** @var Role $role */
        $role = Role::query()->first();

        $permission = Permission::query()->create(['name' => 'Создать данные', 'guard_name' => 'api']);

        $role->givePermissionTo($permission);
    }
}
