<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us</title>
    
    <style>
        h5 {
            color: blue;
        }
        .p1 {
            text-align: justify;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .about-content {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }
        .about-text {
            flex: 1;
            text-align: justify;
        }
        img {
            float: left;
            max-width: 40%;
            height: auto;
            margin-right: 20px;
        }
        mark {
            background-color: yellow;
            padding: 2px;
        }
        ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
    <img src="img/about.jpg" alt="About Us">
    <div class="about-content">
        <div class="about-text">
            <p>TVHub is a virtual marketplace designed to simplify the process of purchasing Televisions. Here you can explore a wide selection of televisions, including the latest smart TV models, from the comfort of your home.</p>
            <h4><mark>Vision</mark></h4>
            <p>To make the world a more clear, colorful, and happier place.</p>
            <h4><mark>Mission</mark></h4>
            <p>We strive to offer our customers the lowest possible prices, the best available selection, and the utmost convenience.</p>
        </div>

        <div class="about-text">
            <h3><mark>BUILDING THE FUTURE</mark></h3>
            <p>At TVHub, we strive to positively impact our customers, employees, small businesses, the economy, and communities. We're a diverse and passionate team, united by a desire to learn and innovate for our customers.</p>
            <ul>
                <li><strong>Market Development:</strong> Expanding into new markets.</li>
                <li><strong>Market Penetration:</strong> Increasing revenue in existing markets.</li>
                <li><strong>Product Development:</strong> Creating and offering new products.</li>
                <li><strong>Diversification:</strong> Exploring new business opportunities.</li>
            </ul>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
