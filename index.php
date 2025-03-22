<?php
session_start();

if(!isset($_SESSION['...']))
{
    header("Location: login.php");
    exit();
}

// Establish database connection and start session
require("common.php");

// // Redirect logged-in users to products page
// if (isset($_SESSION['email'])) {
//     header('location: login.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | TVHub</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            padding-top: 50px;
            text-align: center;
        }
        
        #banner_image {
            background: url('/img/2.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        #banner_content {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 5px;
            display: inline-block;
        }
        
        .shop-btn {
            display: inline-block;
            background: red;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .shop-btn:hover {
            background: darkred;
        }
    </style>
</head>
<body>

<!-- Header -->
<?php include 'includes/header.php'; ?>


<!-- Main Banner -->
<div id="banner_image">
    <div id="banner_content">
        <h1>"Your Lifestyle, Our Screens."</h1>
        <p>Flat 40% OFF on premium brands</p>
        <a href="products.php" class="shop-btn">Shop Now</a>
    </div>
</div>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</body>
</html>
