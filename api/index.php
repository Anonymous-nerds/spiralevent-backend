<?php

require __DIR__ . '/routes/SampleRoute.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

if ($path === '/' && $requestMethod === 'GET') {
  echo json_encode(['message' => 'Test route works']);
} elseif ($path === '/phpinfo' && $requestMethod === 'GET') {
  phpinfo();
  exit;
}

?>


