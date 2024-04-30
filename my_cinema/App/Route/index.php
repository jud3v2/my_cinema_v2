<?php

$allFiles = glob(__DIR__ . '/*.php');
$excludeFiles = ['index.php', 'Route.php'];
$filteredRoutes = array_diff($allFiles, $excludeFiles);

foreach ($filteredRoutes as $route) {
    require_once $route;
}