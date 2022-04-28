<?php

if (!function_exists('is_route')) {

    /**
     * @param array $route_names
     * @param string|null $type
     * @return bool|string
     */
    function is_route(array $route_names, ?string $type = null)
    {
        $types = [
            'group' => 'menu-is-opening menu-open',
            'link' => 'active'
        ];
        $in = in_array(\Illuminate\Support\Facades\Route::currentRouteName(), $route_names);

        if (is_null($type)) {
            return $in;
        }

        return $in ? $types[$type] : '';
    }
}

if (!function_exists('is_super_admin')) {
    /**
     * @return bool
     */
    function is_super_admin(): bool
    {
        return auth()->user()->post == 1;
    }
}
