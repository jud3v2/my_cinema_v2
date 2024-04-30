<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Users.php';

header('Accept: application/json');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: *');

$requestBody = json_decode(file_get_contents("php://input"), true);

if(isset($requestBody['id'])) {
        http_response_code(200);
        $user = new Users();
        if($user->findOneById($requestBody['id'])) {
                print_r($user->deleteOne(intval($requestBody['id'])));
                echo json_encode(["success" => "User deleted"]);
        } else {
                http_response_code(404);
                echo json_encode(["error" => "User not found"]);
        }
        exit();
} else {
        http_response_code(400);
        echo json_encode(["error" => "Invalid request body"]);
        exit();
}