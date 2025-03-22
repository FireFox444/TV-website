<?php
session_start();

require("common.php");

// Redirect if user is already logged in
// if (isset($_SESSION['email'])) {
//     header('location: products.php'); // Redirect to products.php if already logged in
//     exit();
// }

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    // Hash password
    // $password = md5($password);

    // Validation rules
    $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z]{2,3})$/";
    $regex_num = "/^[789][0-9]{9}$/";

    // Check if email already exists
    $query = "SELECT id FROM users WHERE email=?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $num = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);

        if ($num > 0) {
            $message = "<span class='error'>Email already exists!</span>";
        } elseif (!preg_match($regex_email, $email)) {
            $message = "<span class='error'>Invalid email format!</span>";
        } elseif (!preg_match($regex_num, $contact)) {
            $message = "<span class='error'>Invalid phone number!</span>";
        } else {
            // Insert user into database
            $query = "INSERT INTO users (name, email, password, contact, city, address) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $password, $contact, $city, $address);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                // Redirect to login page after successful signup
                header('location: login.php');
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>

    <style>
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
        .success {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
    <h2>Sign Up</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Name" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" required>
        <input type="email" name="email" placeholder="Enter a valid Email" required>
        <input type="password" name="password" placeholder="Password (Min 8 chars, 1 uppercase, 1 lowercase, 1 number)" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
        <input type="text" name="contact" placeholder="Contact (e.g. 8444844863)" maxlength="10" pattern="[789][0-9]{9}" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="text" name="address" placeholder="Address" required>
        <button type="submit" class="btn">Submit</button>
    </form>

    <?php if ($message) echo "<p>$message</p>"; ?>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>
