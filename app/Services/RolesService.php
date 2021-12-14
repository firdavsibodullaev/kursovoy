<?php

namespace App\Services;

use App\Models\User;

/**
 * Class RolesService
 * @package App\Services
 */
class RolesService
{
    public function roles()
    {

    }

    public function giveRole(User $user, array $roles)
    {
        $user->assignRole($roles);
    }
}
