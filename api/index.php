<?php

// Handle API routes
include '../routes/SimpleRoute.php'; 

 header("Content-Type: application/json");

// Parse incoming requests
$requestMethod = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

// Debugging: output the request URI and method
// echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
// echo "Request Method: " . $requestMethod . "<br>";

$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

if ($path === '/' && $requestMethod === 'GET') {
  echo json_encode(['message' => 'Test route works']);
}


?>
