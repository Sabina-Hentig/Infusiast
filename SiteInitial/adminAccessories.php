<!DOCTYPE html>
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
        <h1>Add Accessories</h1>
        <br><br>
        <form class="form-container" action="add_accessories.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
            </div>
            <div>
                <label for="quantity">Quantity:</label>
                <input type="text" id="quantity" name="quantity" required>
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <br>
            <div>
                <label for="state">State:</label>
                <select name="state" id="state">
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <br>
            <button type="submit">Add Accessories</button>
        </form>
    </div>
    <br><br>
    <div class="query-container">
        <h1>Accessories</h1>
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>State</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                
             <?php
              $cnx = mysqli_connect("localhost", "root", "", "infusiast4");
              if (mysqli_connect_errno()) {
                   die("Connection failed: " . mysqli_connect_error());
              }
            
              $query = "SELECT pa.id, pa.product_name, pia.quantity, pa.is_active FROM product_accessories pa JOIN product_inventory_accessories pia ON pa.id = pia.product_id";
              $result = mysqli_query($cnx, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($row['quantity'], ENT_QUOTES, 'UTF-8') . "</td>";
                    if ($row['is_active'] === 'active') {
                        echo "<td style='color: green;'>Active</td>";
                    } else {
                        echo "<td style='color: red;'>Inactive</td>";
                    }
            
                    echo "<td>";
                    echo "<button type='button' class='actions-btn' onclick=\"window.location.href='edit_accessories.php?id=" . $row['id'] . "'\">Edit</button> ";
                    echo "<button type='button' class='actions-btn' onclick=\"if(confirm('Are you sure you want to delete this item?')) { window.location.href='delete_accessories.php?id=" . $row['id'] . "'; }\">Delete</button>";
                    echo "</td>";
                    echo "</tr>";
              }
              mysqli_close($cnx);
               ?>
            
            </tbody>
        </table>
    </div>
</div>
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
