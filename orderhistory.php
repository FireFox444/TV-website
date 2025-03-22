<?php
session_start();

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}
require("common.php");

// Redirect to login page if user is not logged in
// if (!isset($_SESSION['user_id'])) {
//     header('location: login.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order History</title>

    <style>
        /* Ensure full height layout */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            background: #f4f4f4;
            text-align: center;
            font-family: Arial, sans-serif;
        }


        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 50px;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-table th,
        .order-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .order-table th {
            background: #222;
            color: white;
        }

        .total-row {
            font-weight: bold;
            background: #ddd;
        }

        /* Push content area to fill available space */
        .content {
            flex: 1;
            /* This will push the footer to the bottom */
            padding: 20px;
        }


        /* Fix footer at bottom */
        footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 15px 0;
            width: 100%;
            position: relative;
            /* Change to 'fixed' if you want it always visible */
            bottom: 0;
        }
    </style>
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h1>Order History</h1>

        <table class="order-table">
            <?php
            $user_id = $_SESSION['user_id'];
            $query = "SELECT items.name AS Name, items.price AS Price, user_item.date_time AS Timedate 
                  FROM user_item 
                  JOIN items ON user_item.item_id = items.id 
                  WHERE user_item.user_id='$user_id' AND user_item.order_status='Delivered' 
                  ORDER BY user_item.date_time DESC";

            $result = mysqli_query($con, $query) or die(mysqli_error($con));

            if (mysqli_num_rows($result) >= 1) {
            ?>
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Order Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $total += $row["Price"];
                        echo "<tr>
                            <td>{$row["Name"]}</td>
                            <td>Rs. {$row["Price"]}</td>
                            <td>{$row["Timedate"]}</td>
                          </tr>";
                    }
                    echo "<tr class='total-row'><td>Total</td><td colspan='2'>Rs. {$total}</td></tr>";
                    ?>
                </tbody>
            <?php
            } else {
                echo "<tr><td colspan='3'>Sorry! No orders placed yet.</td></tr>";
            }
            ?>
        </table>
    </div>

    <?php include("includes/footer.php"); ?>

</body>

</html>