<?php
session_start();

// if(!isset($_SESSION['email']))
// {
//     header("Location: login.php");
//     exit();
// }
require("common.php");

// Redirect to login page if user is not logged in
// if (!isset($_SESSION['user_id'])) {
//     header('location: login.php');
//     exit();
// }

$order_placed = false;

// Handle order placement
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Secure query using prepared statement
    $query = "INSERT INTO user_item (user_id, item_id, status) VALUES (?, ?, 'Confirmed')";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $item_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $order_placed = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmation</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background: #f4f4f4;
        }
        .container {
            width: 60%;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 50px;
        }
        h3 {
            color: green;
        }
        .back-link {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: blue;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
    <?php if ($order_placed) { ?>
        <h3>Your order has been placed successfully. Thank you for shopping with us.</h3>
        <hr>
        <p>Your order will be delivered in 2 days.</p>
        <hr>
        <p>Click <a href="products.php" class="back-link">here</a> to purchase another item.</p>
    <?php } else { ?>
        <h3>No order was placed. Please try again.</h3>
        <p>Click <a href="products.php" class="back-link">here</a> to return to the store.</p>
    <?php } ?>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>
