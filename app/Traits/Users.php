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

            $last = $user->last_name;
            $first = $user->first_name[1] == '\''
                ? substr($user->first_name, 0, 2)
                : substr($user->first_name, 0, 1);
            $patronymic = $user->patronymic[1] == '\''
                ? substr($user->patronymic, 0, 2)
                : substr($user->patronymic, 0, 1);

            if ($key === 0) {
                $users .= "{$last} {$first}. {$patronymic}.";
                continue;
            }
            $users .= ",<br/>{$last} {$first}. {$patronymic}.";
        }

        return $users;
    }
}
