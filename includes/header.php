<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TVHub</title>

    <style>
        /* Navbar Styling */
        .navbar {
            background: #222;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1000;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.3);
        height: 60px; /* Set a fixed height */        
    }
    .container {
        margin-top: 80px; /* Push content down */
    }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 15px;
            padding: 0 30px ;
            margin: 0;
        }
        .nav-links li {
            display: inline;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .nav-links a:hover {
            background: blue;
        }

        /* Mobile Menu */
        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
        }
        @media screen and (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                background: #333;
                position: absolute;
                top: 60px;
                right: 0;
                width: 200px;
                text-align: right;
                padding: 10px;
                border-radius: 5px;
            }
            .nav-links.show {
                display: flex;
            }
            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <a class="navbar-brand" href="index.php">TVHub</a>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <ul class="nav-links" id="nav-menu">
        <?php if (isset($_SESSION['email'])) { ?>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="view_status.php">view status</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="orderhistory.php">Order History</a></li>
            <li><a href="logout_script.php">Logout</a></li>

        <?php } else { ?>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="aboutus.php">About Us</a></li>
        <?php } ?>
    </ul>
</div>

<script>
    function toggleMenu() {
        document.getElementById("nav-menu").classList.toggle("show");
    }
</script>

</body>
</html>
