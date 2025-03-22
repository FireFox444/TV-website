<?php
include 'admin_header.php';
include '../common.php'; // Database connection

// Handle status update
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['order_status'];
    
    $query = "UPDATE user_item SET order_status='$new_status' WHERE id='$order_id'";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Order status updated!'); window.location='manage_orders.php';</script>";
    }
}

// Fetch orders
$order_query = "SELECT user_item.id AS OrderID, users.name AS User, items.name AS Product, user_item.order_status AS Status 
                FROM user_item 
                JOIN users ON user_item.user_id = users.id 
                JOIN items ON user_item.item_id = items.id 
                "; // Only confirmed orders

$order_result = mysqli_query($con, $order_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Orders</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background: #222;
            color: white;
        }

        .btn {
            padding: 5px 10px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Orders</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>User</th>
            <th>Product</th>
            <th>Status</th>
            <th>Update</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($order_result)) { ?>
        <tr>
            <td><?php echo $row['OrderID']; ?></td>
            <td><?php echo $row['User']; ?></td>
            <td><?php echo $row['Product']; ?></td>
            <td><?php echo $row['Status']; ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="order_id" value="<?php echo $row['OrderID']; ?>">
                    <select name="order_status">
                        <option value="Pending" <?php if ($row['Status'] == 'Pending') echo "selected"; ?>>Pending</option>
                        <option value="Shipped" <?php if ($row['Status'] == 'Shipped') echo "selected"; ?>>Shipped</option>
                        <option value="Out for Delivery" <?php if ($row['Status'] == 'Out for Delivery') echo "selected"; ?>>Out for Delivery</option>
                        <option value="Delivered" <?php if ($row['Status'] == 'Delivered') echo "selected"; ?>>Delivered</option>
                    </select>
                    <button type="submit" name="update_status" class="btn">Update</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include 'admin_footer.php'; ?>
</body>
</html>
