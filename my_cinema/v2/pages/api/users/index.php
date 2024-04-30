<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/Model/Users.php';

$usersModel = new Users();
$users = $usersModel->findMany(500, 0);

http_response_code(200);
header('Content-Type: application/json');
echo json_encode($users);