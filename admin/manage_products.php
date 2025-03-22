<?php
include 'admin_header.php';
include '../common.php'; // Database connection

// Fetch all products
$product_query = "SELECT * FROM items";
$product_result = mysqli_query($con, $product_query);

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM items WHERE id=$id";
    if (mysqli_query($con, $delete_query)) {
        echo "<script>alert('Product deleted successfully!'); window.location='manage_products.php';</script>";
    } else {
        echo "<script>alert('Error deleting product!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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
            padding: 8px 12px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            display: inline-block;
            margin: 5px;
        }

        .edit {
            background: #28a745;
        }

        .delete {
            background: #dc3545;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Products</h2>
    <a href="add_product.php" class="btn edit">Add New Product</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price (₹)</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($product_result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
                <a href="manage_products.php?delete=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include 'admin_footer.php'; ?>
</body>
</html>
