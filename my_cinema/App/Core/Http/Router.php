<?php

namespace App\Core\Http;

use Exception;

abstract class Router {
    protected static function match(array $parsedRoute): bool
    {
        $requestedUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $requestedUri = array_filter($requestedUri, function ($value) {
            return $value !== '';
        });

        // Check if the number of segments match
        if (count($parsedRoute) !== count($requestedUri)) {
            return false;
        }

        // Compare each segment of the route, considering parameters
        foreach ($parsedRoute as $key => $value) {
            if ($value !== $requestedUri[$key] && !self::isParameter($value)) {
                return false;
            }
        }

        return true;
    }

    protected static function execute(string $callback, array $parameter = []): void
    {
        if (str_contains($callback, '@')) {
            $callback = explode('@', $callback);
            $controller = 'App\\Controller\\' . $callback[0];
            $callback = [new $controller($_SERVER), $callback[1]];
        }

        echo call_user_func_array($callback, $parameter);
    }

    protected static function parseRouteWithParameter(string $route): array
    {
        $route = explode('/', $route);
        $route = array_filter($route, function ($value) {
            return $value !== '';
        });
        return array_values($route);
    }

    protected static function isParameter(string $segment): bool
    {
        return str_starts_with($segment, '{') && str_ends_with($segment, '}');
    }

    protected static function executeAll($route, $callback): void
    {
        $parsedRoute = self::parseRouteWithParameter($route);

        if (in_array('{id}', $parsedRoute)) {
            $parsedRoute = self::parseRouteWithParameter($route);
            $parameter = self::getSanitizedURI();
            $routeParams = [];

            foreach ($parsedRoute as $key => $param) {
                if (str_starts_with($param, '{') && str_ends_with($param, '}')) {
                    $paramName = trim($param, '{}');
                    $paramValue = $parameter[$key] ?? null;

                    $routeParams[$paramName] = $paramValue;
                }
            }

            self::execute($callback, $routeParams);
        } elseif (self::match($parsedRoute)) {
            self::execute($callback, $parsedRoute);
        } else {
            throw new Exception('Route not found');
        }
    }

    protected static function getSanitizedURI(): array
    {
        return array_filter(
            explode('/', trim($_SERVER['REQUEST_URI'], '/')), function ($value) {
            return $value !== '';
        });
    }
}