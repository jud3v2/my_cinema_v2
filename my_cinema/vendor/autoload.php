<?php
function autoload_classes(): void
{
    $classes = [
        'App' => $_SERVER['DOCUMENT_ROOT'] . '/App/',
        'App/Core/Model' => $_SERVER['DOCUMENT_ROOT'] . '/App/Core/Model',
        'App/Core/Http/Router' => $_SERVER['DOCUMENT_ROOT'] . '/App/Core/Http/Router',
        'App/Core/Controller.php' => $_SERVER['DOCUMENT_ROOT'] . '/App/Core/Controller.php',
        'App/ore/Controller' => $_SERVER['DOCUMENT_ROOT'] . '/App/Core/Controller',
        'App/Controller' => $_SERVER['DOCUMENT_ROOT'] . '/App/Controller/',
        'App/Core' => $_SERVER['DOCUMENT_ROOT'] . '/App/Core/',
        'App/Core/View.php' => $_SERVER['DOCUMENT_ROOT'] . '/App/Core/View.php',
        'App/Core/Http' => $_SERVER['DOCUMENT_ROOT'] . '/App/Core/Http/',
        'App/Core/Http/Request' => $_SERVER['DOCUMENT_ROOT'] . '/App/Core/Http/Request',
        'App/Core/Http/RouterListener' => $_SERVER['DOCUMENT_ROOT'] . '/App/Core/Http/RouterListener',
        'App/Route/index.php' => $_SERVER['DOCUMENT_ROOT'] . '/App/Route/index.php',
    ];

    foreach ($classes as $name => $path) {
        foreach (glob($path . '*') as $class) {
            if (preg_match('/.php$/', $class)) {
                include_once $class;
            } elseif (is_dir($class)) {
                continue;
            } else {
                include_once $class . '.php';
            }
        }
    }
}

spl_autoload_register('autoload_classes');