<?php
include 'admin_header.php';
include '../common.php'; // Database connection

if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    
    if (!empty($name) && !empty($price) && is_numeric($price) && isset($_FILES['image'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = "admin/uploads/" . basename($image_name);


        if (move_uploaded_file($image_tmp_name, "../" . $image_folder)) {
            $query = "INSERT INTO items (name, price, image) VALUES ('$name', '$price', '$image_folder')";
            if (mysqli_query($con, $query)) {
                echo "<script>alert('Product added successfully!'); window.location='manage_products.php';</script>";
            } else {
                echo "<script>alert('Error adding product!');</script>";
            }
        } else {
            echo "<script>alert('Error uploading image!');</script>";
        }
    } else {
        echo "<script>alert('Invalid input! Please fill all fields correctly.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn {
            padding: 8px 12px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            display: inline-block;
            margin: 5px;
            cursor: pointer;
            border: none;
        }

        .submit {
            background: #007bff;
        }

        .back {
            background: #6c757d;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Enter Product Name" required>
        <input type="number" name="price" placeholder="Enter Product Price" required>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit" name="add_product" class="btn submit">Add Product</button>
        <a href="manage_products.php" class="btn back">Back</a>
    </form>
</div>

<?php include 'admin_footer.php'; ?>
</body>
</html>
