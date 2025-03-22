<?php
session_start();

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}
require("common.php");

// Redirect if user is not logged in
// if (!isset($_SESSION['user_id'])) {
//     header('location: login.php');
//     exit();
// }

$user_id = $_SESSION['user_id'];
$query = "SELECT items.name AS Name, items.price AS Price, user_item.order_status AS Status 
          FROM user_item 
          JOIN items ON user_item.item_id = items.id 
          WHERE user_item.user_id = '$user_id' AND user_item.order_status != 'Delivered'"; // Only confirmed orders
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Status</title>
    <style>
         html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            text-align: center;
            background: #f4f4f4;
            font-family: Arial, sans-serif;
        }
      
        .container {
            width: 70%;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #222;
            color: white;
        }

        .status {
            font-weight: bold;
            color: green;
        }
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
    <h2>Order Status</h2>
    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['Name']; ?></td>
            <td>Rs. <?php echo number_format($row['Price']); ?></td>
            <td class="status"><?php echo $row['Status']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
