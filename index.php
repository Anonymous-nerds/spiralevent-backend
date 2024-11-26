<?php
include './controllers/UserController.php';// Adjust path as needed

header("Content-Type: application/json");

// Parse incoming requests
$requestMethod = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

// Handle API routes
if ($_SERVER['REQUEST_URI'] === '/api/register' && $requestMethod === 'POST') {
    registerUser($db, $input['name'], $input['email'], $input['password']);
} elseif ($_SERVER['REQUEST_URI'] === '/api/login' && $requestMethod === 'POST') {
    loginUser($db, $input['email'], $input['password']);
} elseif ($_SERVER['REQUEST_URI'] === '/api/update' && $requestMethod === 'PUT') {
    updateUser($db, $input['id'], $input['name'], $input['email']);
} elseif ($_SERVER['REQUEST_URI'] === '/api/delete' && $requestMethod === 'DELETE') {
    deleteUser($db, $input['id']);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Endpoint not found']);
}
?>
