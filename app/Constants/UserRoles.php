<?php


namespace App\Constants;


class UserRoles
{
    const SUPER_ADMIN = 'super_admin';
    const REKTOR = 'rektor';
    const PROREKTOR = 'prorektor';
    const DEKAN = 'dekan';
    const KAFEDRA = 'kafedra';
    const TEACHER = 'teacher';


    public static function list(): array
    {
        return [
            self::SUPER_ADMIN,
            self::REKTOR,
            self::PROREKTOR,
            self::DEKAN,
            self::KAFEDRA,
            self::TEACHER,
        ];
    }

    /**
     * @param string|null $role
     * @return array|string
     */
    public static function translate(?string $role = null)
    {
        $roles = [
            self::SUPER_ADMIN => __('Админ'),
            self::REKTOR => __('Ректор'),
            self::PROREKTOR => __('Проректор'),
            self::DEKAN => __('Декан'),
            self::KAFEDRA => __('Кафедра бошлиғи'),
            self::TEACHER => __('Ўқитувчи'),
        ];

        if (is_null($role)) {
            return $roles;
        }

        return $roles[$role];
    }
}
