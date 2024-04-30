<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/Model/Movie.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie = new Movie();
    $query = $_GET['query'];
    $limit = $_GET['limit'] ?? 10;
    $date = $_GET['date'] ?? null;
    $offset = $_GET['offset'] ?? 0;
    $genre = $_GET['genre'] ?? null;
    $date = $date ? str_replace('/', '-', $date) : null;

    //format date to yyyy-mm-dd
    $date = $date ? date('Y-m-d', strtotime($date)) : null;
    $_query = $date ? "title LIKE \"%".$query."%\" AND release_date LIKE \"%$date%\" LIMIT $limit" : "title LIKE \"%".$query."%\" LIMIT $limit OFFSET $offset";
    $response = array(
        'status' => 'success',
        'message' => 'Request processed successfully',
        'data' => $movie->findByWhere($_query)
    );

    http_response_code(200);
    header('Content-Type: application/json');
// Convert the response array to JSON
    $jsonResponse = json_encode($response);

// Output the JSON response
    echo $jsonResponse;
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