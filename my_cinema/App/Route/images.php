<?php

namespace App\Route;

$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/images/my_cinema.png') {
    header('Content-Type: image/png');
   return  readfile($_SERVER['DOCUMENT_ROOT'] . '/images/my_cinema.png');
}