<?php

namespace App\Route;

$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/subscription') {
    Route::get('/subscription', 'SubscriptionController@index');
}