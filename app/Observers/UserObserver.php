<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UserObserver
{
    /**
     * @param User $user
     */
    public function creating(User $user)
    {
        $user->password = Hash::make($user->password);
        $user->phone = str_replace('+', '', $user->phone);
    }

    /**
     * @param User $user
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function updating(User $user)
    {
        $password = request()->get('password');
        if ($password) {
            $user->password = Hash::make($password);
        } else {
            $user->password = $user->getOriginal('password');
        }
        $user->phone = str_replace('+', '', $user->phone);
    }

}
