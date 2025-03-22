<?php
session_start();

// Check if user is logged in before destroying session
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to homepage
header('location: index.php');
exit();
?>
