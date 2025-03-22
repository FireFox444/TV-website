<?php
session_start();
require("common.php");

if (!isset($_SESSION['user_id'])) {
    header("location: login.php"); // Redirect to login if user is not logged in
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET["id"];
    $user_id = $_SESSION['user_id'];

    // Use prepared statement for security
    $query = "DELETE FROM user_item WHERE item_id = ? AND user_id = ? AND status = 'Added to cart'";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $item_id, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("location: cart.php");
    exit();
} else {
    header("location: cart.php"); // Redirect if ID is invalid
    exit();
}
?>
