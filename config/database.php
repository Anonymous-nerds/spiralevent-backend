<?php
// Database connection parameters
$host = 'ep-purple-queen-a55vn1ki.us-east-2.aws.neon.tech';  // Replace with your Neon host
$port = '5432';                 // Neon uses the default PostgreSQL port
$dbname = 'spiral-event';       // Replace with your Neon database name
$user = 'yakubuanas04';         // Replace with your Neon username
$password = 'Pq3fZVXu9jvH';     // Replace with your Neon password
$sslmode = 'require';           // Neon requires SSL connections

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
    // echo "Connected to the Neon PostgreSQL database successfully!";
    
    // Return the database connection
    return $db;
} catch (PDOException $e) {
    // Handle connection errors
    http_response_code(500);
    echo json_encode(['message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}
?>
