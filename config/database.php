<?php
// Database connection parameters
$host = 'ep-purple-queen-a55vn1ki.us-east-2.aws.neon.tech'; 
$port = '5432';      
$dbname = 'spiral-event';
$user = 'yakubuanas04';
$password = 'Pq3fZVXu9jvH';
$sslmode = 'require'; 

// Extract the endpoint ID from the host
$endpoint = explode('.', $host)[0];

// Construct the DSN with the endpoint option
$dsn = "pgsql:host=$host;dbname=$dbname;options=endpoint=$endpoint";

try {
    // Create a PDO instance
    $db = new PDO($dsn, $user, $password);
    
    // Set error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Uncomment this for debugging if needed
     //echo "Connected to the Neon PostgreSQL database successfully!";
    
    // Return the database connection
    return $db;
} catch (PDOException $e) {
    // Handle connection errors
    http_response_code(500);
    echo json_encode(['message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}
?>
