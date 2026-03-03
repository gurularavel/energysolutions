<?php

if (!function_exists('lroute')) {
    /**
     * Generate a locale-prefixed URL for the given named route.
     */
    function lroute(string $name, array $params = []): string
    {
        return route($name, array_merge(['locale' => app()->getLocale()], $params));
    }
}
