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
    }

    /**
     * @param User $user
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function updating(User $user)
    {
        if (request()->has('password')) {
            $user->password = Hash::make(request()->get('password'));
        } else {
            unset($user->password);
        }
    }

}
