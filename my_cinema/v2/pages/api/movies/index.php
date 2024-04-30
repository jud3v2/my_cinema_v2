<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/Model/Movie.php';
http_response_code(200);
header('Content-Type: application/json');
$limit = $_GET['limit'] ?? 100;
$offset = $_GET['offset'] ?? 0;
$movie = new Movie();
// Create a response array
$response = array(
    'status' => 'success',
    'message' => 'Request processed successfully',
    'data' => $movie->findByWhere("release_date ORDER BY release_date DESC LIMIT $limit OFFSET $offset")
);

// Convert the response array to JSON
$jsonResponse = json_encode($response);

// Output the JSON response
echo $jsonResponse;