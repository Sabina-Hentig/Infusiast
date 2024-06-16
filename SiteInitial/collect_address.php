﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infusiast - the tea store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="poze/logo-teastore.png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/adminTea.css">
    <link rel="stylesheet" href="css/footer.css">
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
                    <img src="poze/user.png" alt="User" class="user-icon">
                    Account
                </a>
                <a class="header-btn2" href="basket.php">
                    <img src="poze/basket.png" alt="Basket" class="basket-icon">
                    Basket
                </a>
            </div>
        </div>
    </div>
</header>


<div class="container">
    <br><br>
    <div class="forms-container">
        <h1>Order form</h1>
        <br><br>
        <form class="form-container" action="add_address.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div>
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <br>

            <button type="submit">Place Order</button>
        </form>
    </div>
    <br><br>
   
<br><br>
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
