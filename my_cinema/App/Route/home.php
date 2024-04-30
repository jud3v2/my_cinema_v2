<?php

namespace App\Route;

$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/') {
    Route::get('/', 'HomeController@index');
}