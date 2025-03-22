<?php

// Start session
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

// Database connection
$con = mysqli_connect("localhost", "root", "", "store");

// Check if database connection failed
if (!$con) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
