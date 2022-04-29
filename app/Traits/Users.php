<?php

namespace App\Traits;

use App\Models\User;

/** @property-read string $users_formatted */
trait Users
{
    /**
     * @return string
     */
    public function getUsersFormattedAttribute(): string
    {
        $users = '';
        /** @var User $user */
        foreach ($this->users as $key => $user) {
            if ($key === 0) {
                $users .= "{$user->last_name} {$user->first_name} {$user->patronymic}";
                continue;
            }
            $users .= ",<br/>{$user->last_name} {$user->first_name} {$user->patronymic}";
        }

        return $users;
    }
}
