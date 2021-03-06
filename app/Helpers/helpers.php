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
        return auth()->user()->hasRole(\App\Constants\UserRoles::SUPER_ADMIN);
    }
}

if (!function_exists('random_color')) {

    /**
     * @param array $except_colors
     * @return string
     */
    function random_color(array $except_colors = []): string
    {
        $hex_string = "#" . bin2hex(openssl_random_pseudo_bytes(3));

        if (in_array($hex_string, $except_colors)) {
            return random_color($except_colors);
        }

        return $hex_string;
    }
}

if (!function_exists('get_year_select_options')) {
    /**
     * @param string|null $val
     * @return Generator
     */
    function get_year_select_options(?string $val = null): Generator
    {
        $year = date('Y');
        for ($i = 2022; $i <= $year; $i++) {
            yield "<option " . ($val == $i ? 'selected' : '') . " value='{$i}'>{$i}</option>";
        }
    }
}

if (!function_exists('has_access_to_edit')) {
    /**
     * @param mixed $user_id
     * @return bool
     */
    function has_access_to_edit($user_id): bool
    {
        if (!auth()->check()) {
            return false;
        }

        if (is_super_admin()) {
            return true;
        }

        if (is_array($user_id) && !in_array(auth()->id(), $user_id)) {
            return false;
        }

        if (!is_array($user_id) && $user_id != auth()->id()) {
            return false;
        }

        return true;
    }
}

if (!function_exists('br2nl')) {
    function br2nl(string $string)
    {
        return str_ireplace(["<br />", "<br>", "<br/>"], " \n", $string);
    }
}
