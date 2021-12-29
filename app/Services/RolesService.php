<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

/**
 * Class RolesService
 * @package App\Services
 */
class RolesService
{
    public function roles()
    {
        Artisan::call("cache:clear");
        $start = microtime(true);
        $users = User::query()->count();
        dd($users);
        foreach ($users as $user) {
            echo $user->id . " ";
        }
        dd(((microtime(true) - $start) * 1000) . " ms", "Memory usage: " . (memory_get_usage(true) / (1024 * 1024)) . " mb");
    }

    public function giveRole(User $user, array $roles)
    {
        $user->assignRole($roles);
    }
}
