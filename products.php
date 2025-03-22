<?php
session_start();

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}
require("common.php");

// Redirect users to login page if not logged in
// if (!isset($_SESSION['email'])) {
//     header('location: login.php');
//     exit();
// }
?>
<?php
// Establish database connection
require("common.php");

// Fetch all TV products from the database
$query = "SELECT * FROM items ";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            margin-top: 80px; /* Push content below the fixed navbar */
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }
        .product {
            width: 22%;
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            background: white;
        }
        .product img {
            width: 100%;
            height: auto;
            max-height: 180px;
            object-fit: cover;
            border-radius: 5px;
        }
        .product h3 {
            font-size: 18px;
            margin: 10px 0;
        }
        .product p {
            font-size: 16px;
            color: green;
        }
        .buy-btn {
            display: block;
            background: blue;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .buy-btn:hover {
            background: darkblue;
        }
    </style>
</head>

<body>

<?php include 'includes/header.php'; ?>

<div class="container">
    <h1>Welcome to TVHub!</h1>
    <p>Your central place for all television needs.</p>
    <hr>

    <div class="product-grid">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='product'>";
            echo "<img src='admin/" . $row['image'] . "' alt='" . $row['name'] . "'>";
            echo "<h3>" . $row['name'] . "</h3>";
            echo "<p>Price: Rs. " . number_format($row['price']) . "</p>";

            if (!isset($_SESSION['email'])) {
                echo "<a href='login.php' class='buy-btn'>Buy Now</a>";
            } else {
                include 'includes/check-if-added.php';
                if (check_if_added_to_cart($row['id'])) {
                    echo "<a href='#' class='buy-btn' style='background: gray;' disabled>Added to Cart</a>";
                } else {
                    echo "<a href='cart-add.php?id=" . $row['id'] . "' class='buy-btn'>Add to Cart</a>";
                }
            }
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>
