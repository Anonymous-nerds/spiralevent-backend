<?php

// Database connection parameters
$host = "mysql-c8c64e5-yakubuanas04-4794.c.aivencloud.com";
$username = "avnadmin";
$password = "AVNS_sGhp-VO6rl7yZhKPDYO";
$db_name = "defaultdb";
$port = "21965"; // Port for the remote MySQL server

// SSL certificate file path (adjust if necessary)
$ssl_ca = "ca.pem"; // Make sure ca.pem is in the correct location

// Create a connection with SSL options
$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL, $ssl_ca, NULL, NULL);

// Establish connection to the MySQL database
if (!mysqli_real_connect($con, $host, $username, $password, $db_name, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Test the connection
echo "Connected successfully!";

// Example query to test the database
$result = mysqli_query($con, "SELECT VERSION()");
$row = mysqli_fetch_array($result);
echo " MySQL Version: " . $row[0];

// Close the connection
//mysqli_close($con);
?>
