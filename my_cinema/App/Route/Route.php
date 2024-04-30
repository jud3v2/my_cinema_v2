<?php

namespace App\Route;

use App\Core\Http\Router;

class Route extends Router
{
    public static function get(string $route, string $callback): void
    {
        self::executeAll($route, $callback);
    }

    public static function post(string $route, string $callback): void
    {
        echo $route . ' ' . $callback();
    }

    public static function put(string $route, string $callback): void
    {
        echo $route . ' ' . $callback();
    }

    public static function patch(string $route, string $callback): void
    {
        echo $route . ' ' . $callback();
    }

    public static function delete(string $route, string $callback): void
    {
        echo $route . ' ' . $callback();
    }
}