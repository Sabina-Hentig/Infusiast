<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Infusiast - the tea store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        /* Include the CSS here for convenience, or keep it in your external CSS file */
        /* Add the CSS provided above here */
    </style>
</head>
<body>
<header>
    <div class="header">
        <img class="company-logo" src="poze/logo-teastore.png" alt="Logo">
        <div class="header-container">
            <div class="header-btn-container">
                <a class="header-btn" href="index.php">Home</a>
                <a class="header-btn" href="tea.php">Tea</a>
                <a class="header-btn" href="accessories.php">Accessories</a>
                <a class="header-btn" href="contact.html">Contact</a>
            </div>
            <div class="header-btn-container2">
                <a class="header-btn2" href="login.html">
                    <img src="poze/user.png" alt="User" class="user-icon"> Account
                </a>
                <a class="header-btn2" href="basket.php">
                    <img src="poze/basket.png" alt="Basket" class="basket-icon"> Basket
                </a>
            </div>
        </div>
    </div>
</header>

<br>
<br>

<div id="slider">
    <figure>
        <img src="images/image1.png" onclick="window.location.href='tea.php'">
        <img src="images/image2.png" onclick="window.location.href='accessories.php'">
        <img src="images/image3.png">
    </figure>
</div>

<div class="container">
    <h1>Our Teas</h1>
    <div class="product-list">
   
        <?php include 'fetch_products.php'; ?>
    </div>
</div>


<div class="container">
    <h1>Our Accessories</h1>
    <div class="product-list">
   
        <?php include 'fetch_products_accessories.php'; ?>
    </div>
</div>

<footer>
    <div class="footer">
        <div class="footer-contact-info">
            <p>Mail: <a href="mailto:tea@infusiast.com">tea@infusiast.com</a></p>
            <p>|</p>
            <p>Tel.: +40 740 000 000</p>
        </div>
        <div class="footer-copyright">
            <p>&copy; 2024 Infusiast srl. All rights reserved.</p>
        </div>
    </div>
</footer>
</body>
</html>
