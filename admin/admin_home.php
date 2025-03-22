<?php
include 'admin_header.php';
include '../common.php'; // Database connection

// Fetch total products
$product_query = "SELECT COUNT(*) AS total_products FROM items";
$product_result = mysqli_query($con, $product_query);
$product_data = mysqli_fetch_assoc($product_result);
$total_products = $product_data['total_products'];

// Fetch total users
$user_query = "SELECT COUNT(*) AS total_users FROM users";
$user_result = mysqli_query($con, $user_query);
$user_data = mysqli_fetch_assoc($user_result);
$total_users = $user_data['total_users'];

// Fetch total orders
$order_query = "SELECT COUNT(*) AS total_orders FROM user_item WHERE order_status='Confirmed'";
$order_result = mysqli_query($con, $order_query);
$order_data = mysqli_fetch_assoc($order_result);
$total_orders = $order_data['total_orders'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        .dashboard {
            text-align: center;
            padding: 20px;
        }

        .dashboard-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 200px;
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<section class="dashboard">
    <h2>Welcome to Admin Panel</h2>
    <div class="dashboard-cards">
        <div class="card">
            <h3>Total Products</h3>
            <p><?php echo $total_products; ?></p>
        </div>
        <div class="card">
            <h3>Total Users</h3>
            <p><?php echo $total_users; ?></p>
        </div>
        <div class="card">
            <h3>Total Orders</h3>
            <p><?php echo $total_orders; ?></p>
        </div>
    </div>
</section>

<?php include 'admin_footer.php'; ?>
</body>
</html>
