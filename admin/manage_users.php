<?php
include 'admin_header.php';
include '../common.php'; // Database connection

// Fetch all users
$user_query = "SELECT * FROM users";
$user_result = mysqli_query($con, $user_query);

// Handle delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM users WHERE id=$id";
    
    if (mysqli_query($con, $delete_query)) {
        echo "<script>alert('User deleted successfully!'); window.location='manage_users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Users</title>
    <style>
        .container { width: 80%; margin: auto; padding: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ddd; }
        th { background: #222; color: white; }
        .btn { padding: 8px 12px; text-decoration: none; color: white; border-radius: 5px; display: inline-block; margin: 5px; }
        .edit { background: #28a745; }
        .delete { background: #dc3545; }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>City</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($user_result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td>
                <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
                <a href="manage_users.php?delete=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include 'admin_footer.php'; ?>
</body>
</html>
