<?php

namespace App\Core\Http;

abstract class Request {
    public array $request;

    public function __construct()
    {
        $this->request = $_SERVER;
    }
    protected static function uri(): string
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            '/'
        );
    }

    protected static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function data(): array
    {
        return $_SERVER;
    }

    protected function file(string $name): array
    {
        return $_FILES[$name];
    }

    protected function hasFile(string $name): bool
    {
        return isset($_FILES[$name]);
    }

    protected function has(string $name): bool
    {
        return isset($_REQUEST[$name]);
    }

    protected function get(string $name, $default = null)
    {
        return $_SERVER[$name] ?? $default;
    }

    protected function all(): array
    {
        return $_SERVER;
    }

    protected function only(array $keys): array
    {
        return array_intersect_key($_SERVER, array_flip($keys));
    }

    protected function except(array $keys): array
    {
        return array_diff_key($_SERVER, array_flip($keys));
    }

    protected function hasAny(array $keys): bool
    {
        foreach ($keys as $key) {
            if (isset($_SERVER[$key])) {
                return true;
            }
        }

        return false;
    }
}