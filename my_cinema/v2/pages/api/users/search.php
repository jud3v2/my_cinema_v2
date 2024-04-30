<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/Model/Users.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $query = $_GET['q'];
        $user = new Users();
        $result = $user->findByWhere("firstname LIKE '%$query%' OR lastname LIKE '%$query%' OR email LIKE '%$query%';");
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($result);
} else {
    http_response_code(400);
    header('Content-Type: application/json');
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request',
    );
    $jsonResponse = json_encode($response);
    echo $jsonResponse;
}