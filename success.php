<?php
session_start();

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}
require("common.php");

// Redirect if user is not logged in
// if (!isset($_SESSION['email'])) {
//     header('location: login.php');
//     exit();
// }

$user_id = $_SESSION['user_id'];
$item_ids_string = $_GET['itemsid'];

$query = "UPDATE user_item SET order_status='Confirmed' WHERE user_id= $user_id";

$stmt = mysqli_query($con, $query);

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
        .success-image {
            width: 100%;
            max-width: 250px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
    <img src="img/thanks.png" alt="Thank You" class="success-image">
    <h3>Your order is confirmed. Thank you for shopping with us.</h3>
    <hr>
    <p>Click <a href="products.php" class="back-link">here</a> to continue shopping.</p>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>
