<?php

namespace Database\Seeders;

use App\Constants\PermissionsConstant;
use App\Constants\UserRoles;
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
            ['name' => UserRoles::SUPER_ADMIN, 'guard_name' => 'web'],
            ['name' => UserRoles::REKTOR, 'guard_name' => 'web'],
            ['name' => UserRoles::PROREKTOR, 'guard_name' => 'web'],
            ['name' => UserRoles::DEKAN, 'guard_name' => 'web'],
            ['name' => UserRoles::KAFEDRA, 'guard_name' => 'web'],
            ['name' => UserRoles::TEACHER, 'guard_name' => 'web'],
        ]);

        $roles = Role::query()->get();
        $permissions_list = PermissionsConstant::groupedList();

        /** @var Role $role */
        foreach ($roles as $role) {
            foreach ($permissions_list[$role->name] as $permission) {
                $permission = Permission::query()->firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
                $role->givePermissionTo($permission);
            }
        }
    }
}
