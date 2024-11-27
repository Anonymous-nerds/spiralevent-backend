<?php

require 'controllers/SampleController.php'; // Adjust path if needed

 header("Content-Type: application/json");

// Parse incoming requests
$requestMethod = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

// Debugging: output the request URI and method
// echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
// echo "Request Method: " . $requestMethod . "<br>";

$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

if ($path === '/test' && $requestMethod === 'GET') {
  echo json_encode(['message' => 'Test route works']);
}


// Handle API routes for sample
if ($path === '/api/sample' && $requestMethod === 'GET') {
  getData($db);
}elseif ($path === '/sample' && $requestMethod === 'POST') {
    // Parse JSON input
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate input
    if (!isset($input['title']) || !isset($input['content']) || !isset($input['category_id'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid input. Title, content, and category_id are required.']);
        exit;
    }

    // Call the function with the input data
    insertData($db, $input['title'], $input['content'], $input['category_id']);
}elseif ($path === '/sample' && $requestMethod === 'PUT') {
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate input
    if (!isset($input['id']) || !isset($input['title']) || !isset($input['content']) || !isset($input['category_id'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid input. ID, title, content, and category_id are required.']);
        exit;
    }

    // Call the function to update the post
    updateData($db, $input['id'], $input['title'], $input['content'], $input['category_id']);
} elseif ($path === '/sample' && $requestMethod === 'DELETE') {
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate input
    if (!isset($input['id'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid input. ID is required.']);
        exit;
    }

    // Call the function to delete the post
    deleteData($db, $input['id']);
}

 else {
    http_response_code(404);
    echo json_encode(['message' => 'Endpoint not found']);
}
?>
