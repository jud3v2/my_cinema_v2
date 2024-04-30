<?php

include_once  $_SERVER["DOCUMENT_ROOT"].'/Model/Schedule.php';

$schedule = new Schedule();
$result = $schedule->getSchedule(10000);
http_response_code(200);
header('Content-Type: application/json');
echo json_encode($result);