<?php

namespace App\Route;

$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/movies') {
    Route::get('/movies', 'MovieController@index');
} elseif (preg_match('/^\/movies\/\d+$/', $requestUri)) {
    Route::get('/movies/{id}', 'MovieController@show');
}