<?php

// //require 'controllers/SampleController.php'; // Adjust path if needed

// require __DIR__ . '/../controllers/SampleController.php'; // Fix the path using __DIR__


//  header("Content-Type: application/json");

// // Parse incoming requests
// $requestMethod = $_SERVER['REQUEST_METHOD'];
// $input = json_decode(file_get_contents("php://input"), true);

// // Debugging: output the request URI and method
// // echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
// // echo "Request Method: " . $requestMethod . "<br>";

// $requestUri = $_SERVER['REQUEST_URI'];
// $path = parse_url($requestUri, PHP_URL_PATH);

// if ($path === '/test' && $requestMethod === 'GET') {
//   echo json_encode(['message' => 'Test route works']);
// }


// // Handle API routes for sample
// if ($path === '/api/sample' && $requestMethod === 'GET') {
//   getData($db);
// }elseif ($path === '/sample' && $requestMethod === 'POST') {
//     // Parse JSON input
//     $input = json_decode(file_get_contents("php://input"), true);

//     // Validate input
//     if (!isset($input['title']) || !isset($input['content']) || !isset($input['category_id'])) {
//         http_response_code(400);
//         echo json_encode(['message' => 'Invalid input. Title, content, and category_id are required.']);
//         exit;
//     }

//     // Call the function with the input data
//     insertData($db, $input['title'], $input['content'], $input['category_id']);
// }elseif ($path === '/sample' && $requestMethod === 'PUT') {
//     $input = json_decode(file_get_contents("php://input"), true);

//     // Validate input
//     if (!isset($input['id']) || !isset($input['title']) || !isset($input['content']) || !isset($input['category_id'])) {
//         http_response_code(400);
//         echo json_encode(['message' => 'Invalid input. ID, title, content, and category_id are required.']);
//         exit;
//     }

//     // Call the function to update the post
//     updateData($db, $input['id'], $input['title'], $input['content'], $input['category_id']);
// } elseif ($path === '/sample' && $requestMethod === 'DELETE') {
//     $input = json_decode(file_get_contents("php://input"), true);

//     // Validate input
//     if (!isset($input['id'])) {
//         http_response_code(400);
//         echo json_encode(['message' => 'Invalid input. ID is required.']);
//         exit;
//     }

//     // Call the function to delete the post
//     deleteData($db, $input['id']);
// }

//  else {
//     http_response_code(404);
//     echo json_encode(['message' => 'Endpoint not found']);
// }
?>

<?php

// Require SampleController to access database functions (getData, insertData, updateData, deleteData)
require __DIR__ . '/../controllers/SampleController.php'; // Adjust the path if necessary

header("Content-Type: application/json");

// Parse the incoming request
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

// Check the request method and route
if ($path === '/api/sample' && $requestMethod === 'GET') {
    // Fetch all posts
    getData($con);

} elseif ($path === '/api/sample' && $requestMethod === 'POST') {
    // Parse JSON input for POST request
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate input
    if (!isset($input['title']) || !isset($input['content']) || !isset($input['category_id'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid input. Title, content, and category_id are required.']);
        exit;
    }

    // Insert new post data
    insertData($con, $input['title'], $input['content'], $input['category_id']);

} elseif ($path === '/api/sample' && $requestMethod === 'PUT') {
    // Parse JSON input for PUT request
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate input
    if (!isset($input['id']) || !isset($input['title']) || !isset($input['content']) || !isset($input['category_id'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid input. ID, title, content, and category_id are required.']);
        exit;
    }

    // Update existing post data
    updateData($con, $input['id'], $input['title'], $input['content'], $input['category_id']);

} elseif ($path === '/api/sample' && $requestMethod === 'DELETE') {
    // Parse JSON input for DELETE request
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate input
    if (!isset($input['id'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid input. ID is required.']);
        exit;
    }

    // Delete post data by ID
    deleteData($con, $input['id']);

} elseif ($path === '/test' && $requestMethod === 'GET') {
    // Test endpoint
    echo json_encode(['message' => 'Test route works']);

} else {
    // If no valid route is found
    http_response_code(404);
    echo json_encode(['message' => 'Endpoint not found']);
}

