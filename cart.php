<?php
session_start();

// if(!isset($_SESSION['email']))
// {
//     header("Location: login.php");
//     exit();
// }
require("common.php");

// if (!isset($_SESSION['email'])) {
//     header('location: login.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        .cart-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .cart-image img {
            max-width: 200px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .cart-table th,
        .cart-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .cart-table th {
            background: #222;
            color: white;
        }

        .remove-btn {
            color: red;
            cursor: pointer;
            text-decoration: none;
        }

        .confirm-btn {
            display: inline-block;
            background: blue;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
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
        <div class="cart-container">
            <div class="cart-image">
                <img src="img/confirmorder.png" alt="Confirm Order">
            </div>

            <div class="cart-content">
                <table class="cart-table">
                    <?php
                    $sum = 0;
                    $id = '';
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT items.price AS Price, items.id AS id, items.name AS Name, item_id 
                          FROM user_item
                          JOIN items ON user_item.item_id = items.id 
                          WHERE user_item.user_id='$user_id' AND user_item.order_status='pending'";

                    $result = mysqli_query($con, $query) or die(mysqli_error($con));

                    if (mysqli_num_rows($result) >= 1) {
                    ?>
                        <thead>
                            <tr>
                                <th>Item Number</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                $sum += $row["Price"];
                                $id .= $row["id"] . ", ";
                                echo "<tr>
                                    <td>#{$row['id']}</td>
                                    <td>{$row['Name']}</td>
                                    <td>Rs {$row['Price']}</td>
                                    <td><a href='cart-remove.php?id={$row['item_id']}' class='remove-btn'>Remove</a></td>
                                  </tr>";
                            }
                            echo "<tr>
                                <td></td>
                                <td>Total</td>
                                <td>Rs {$sum}</td>
                                <td><a href='success.php?itemsid={$id}' class='confirm-btn'>Confirm Order</a></td>
                              </tr>";
                            ?>
                        </tbody>
                    <?php
                    } else {
                        echo "<tr><td colspan='4'>Your Cart is Empty. Please add items to the cart first!</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".remove-btn").forEach(function(button) {
                button.addEventListener("click", function(event) {
                    event.preventDefault(); // Prevent page reload
                    let itemId = this.getAttribute("href").split("=")[1];
                    let row = this.closest("tr");

                    fetch(`cart-remove.php?id=${itemId}`)
                        .then(response => response.text())
                        .then(() => {
                            row.remove(); // Remove item from table
                        })
                        .catch(error => console.error("Error:", error));
                });
            });
        });
    </script>

</body>

</html>