<?php
session_start();
require("common.php");

// Ensure user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header('location: login.php'); // Redirect to login if not logged in
//     exit();
// }

// Check if 'id' is set and numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Use prepared statement to insert into the database securely
    $query = "INSERT INTO user_item (user_id, item_id, status) VALUES (?, ?, 1)";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $item_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        die("Database Error: " . mysqli_error($con)); // Display database error if query fails
    }

    // Redirect back to the products page
    header('location: products.php');
    exit();
}
?>
