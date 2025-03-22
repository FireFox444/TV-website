<?php
session_start();

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}
require("common.php");

// Redirect if user is not logged in
// if (!isset($_SESSION['email'])) {
//     header('location: login.php');
//     exit();
// }

// Handle password update
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_pass = mysqli_real_escape_string($con, $_POST['old-password']);
    $new_pass = mysqli_real_escape_string($con, $_POST['password']);
    $new_pass1 = mysqli_real_escape_string($con, $_POST['password1']);

    // Hash passwords
    $old_pass = md5($old_pass);
    $new_pass = md5($new_pass);
    $new_pass1 = md5($new_pass1);

    // Get user's current password
    $query = "SELECT password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($con, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $orig_pass = $row['password'];
        mysqli_stmt_close($stmt);

        // Validate password change
        if ($new_pass != $new_pass1) {
            $message = "<span class='error'>The two passwords don't match.</span>";
        } elseif ($old_pass != $orig_pass) {
            $message = "<span class='error'>Wrong Old Password.</span>";
        } else {
            // Update new password
            $query = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = mysqli_prepare($con, $query);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $new_pass, $_SESSION['email']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                $message = "<span class='success'>Password Updated Successfully.</span>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings</title>

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
            width: 30%;
            margin: auto;
            padding: 30px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 50px;
        }
        h2 {
            margin-bottom: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            background: blue;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
        }
        .btn:hover {
            background: darkblue;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .success {
            color: green;
            margin-top: 10px;
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
    <h2>Change Password</h2>

    <form method="POST">
        <input type="password" name="old-password" placeholder="Old Password" required>
        <input type="password" name="password" placeholder="New Password" required>
        <input type="password" name="password1" placeholder="Re-type New Password" required>
        <button type="submit" class="btn">Change Password</button>
    </form>

    <?php if ($message) echo "<p>$message</p>"; ?>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>
