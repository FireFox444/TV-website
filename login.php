<?php
session_start();

require("common.php");

// Redirect to products page if already logged in
// if (isset($_SESSION['email'])) {
//     header('location: login.php');
//     exit();
// }

// Handle login form submission
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    if($email == 'admin' && $password == 'admin')
    {
        header('location: admin/admin_home.php');
        exit();
    }
    
    // Secure query using prepared statement
    $query = "SELECT id, email FROM users WHERE email=? AND password=?";
    $stmt = mysqli_prepare($con, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num = mysqli_num_rows($result);
        
        if ($num == 0) {
            $error = "<span style='color: red;'>Incorrect Email or Password!</span>";
        } else {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location: products.php');
            exit();
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
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
        .register-link {
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
    <h2>Login</h2>
    <p style="color: gray;">Login to make a purchase</p>

    <form method="POST">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn">Login</button>
    </form>

    <?php if ($error) echo "<p class='error'>$error</p>"; ?>

    <p class="register-link">Don't have an account? <a href="signup.php">Register</a></p>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
