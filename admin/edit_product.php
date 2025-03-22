<?php
include 'admin_header.php';
include '../common.php'; // Database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM items WHERE id = $id";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);
}

if (isset($_POST['update_product'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $old_image = $_POST['old_image'];

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = "uploads/" . basename($image_name);

        if (move_uploaded_file($image_tmp_name, "../" . $image_folder)) {
            $new_image = $image_folder;
        } else {
            echo "<script>alert('Error uploading new image!');</script>";
            $new_image = $old_image;
        }
    } else {
        $new_image = $old_image; // Keep existing image if no new one is uploaded
    }

    // Update product details
    $update_query = "UPDATE items SET name = '$name', price = '$price', image = '$new_image' WHERE id = $id";
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Product updated successfully!'); window.location='manage_products.php';</script>";
    } else {
        echo "<script>alert('Error updating product!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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

        .update {
            background: #28a745;
        }

        .back {
            background: #6c757d;
        }

        .preview {
            width: 100px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?= $product['name']; ?>" required>
        <input type="number" name="price" value="<?= $product['price']; ?>" required>
        
        <label>Current Image:</label>
        <img src="../<?= $product['image']; ?>" alt="Product Image" class="preview">
        
        <input type="file" name="image" accept="image/*">
        <input type="hidden" name="old_image" value="<?= $product['image']; ?>">

        <button type="submit" name="update_product" class="btn update">Update Product</button>
        <a href="manage_products.php" class="btn back">Back</a>
    </form>
</div>

<?php include 'admin_footer.php'; ?>
</body>
</html>
