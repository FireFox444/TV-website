<?php
include 'admin_header.php';
include '../common.php'; // Database connection

// Fetch user details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
}

// Handle form submission
if (isset($_POST['update_user'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    $update_query = "UPDATE users SET 
                        name = '$name', 
                        email = '$email', 
                        contact = '$contact', 
                        city = '$city', 
                        address = '$address' 
                    WHERE id = $id";

    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('User updated successfully!'); window.location='manage_users.php';</script>";
    } else {
        echo "<script>alert('Error updating user!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
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
    </style>
</head>
<body>

<div class="container">
    <h2>Edit User</h2>
    <form method="POST">
        <input type="text" name="name" value="<?= $user['name']; ?>" required>
        <input type="email" name="email" value="<?= $user['email']; ?>" required>
        <input type="text" name="contact" value="<?= $user['contact']; ?>" required>
        <input type="text" name="city" value="<?= $user['city']; ?>" required>
        <input type="text" name="address" value="<?= $user['address']; ?>" required>

        <button type="submit" name="update_user" class="btn update">Update User</button>
        <a href="manage_users.php" class="btn back">Back</a>
    </form>
</div>

<?php include 'admin_footer.php'; ?>
</body>
</html>
