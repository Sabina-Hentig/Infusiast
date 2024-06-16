<?php
global $cnx;
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($cnx, $_POST['id']);
    $name = mysqli_real_escape_string($cnx, $_POST['name']);
    $description = mysqli_real_escape_string($cnx, $_POST['description']);
    $quantity = mysqli_real_escape_string($cnx, $_POST['quantity']);
    $state = mysqli_real_escape_string($cnx, $_POST['state']);
    $price = mysqli_real_escape_string($cnx, $_POST['price']);

    $imgContent = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    }

    if ($imgContent) {
        $sql = "UPDATE product SET product_name='$name', description='$description', quantity='$quantity', is_active='$state', price='$price', picture='$imgContent' WHERE id='$id'";
        $sql_inventory = "UPDATE product_inventory SET quantity='$quantity', updated_date='NOW()' WHERE product_id='$id'";
    } else {
        $sql = "UPDATE product SET product_name='$name', description='$description', quantity='$quantity', is_active='$state', price='$price' WHERE id='$id'";
        $sql_inventory = "UPDATE product_inventory SET quantity='$quantity', updated_date='NOW()' WHERE product_id='$id'";
    }

    if (mysqli_query($cnx, $sql) && mysqli_query($cnx, $sql_inventory)){
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($cnx);
    }
}

$id = mysqli_real_escape_string($cnx, $_GET['id']);
$query = "SELECT * FROM product WHERE id='$id'";
$result = mysqli_query($cnx, $query);
$product = mysqli_fetch_assoc($result);

mysqli_close($cnx);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Tea</title>
    <link rel="icon" type="image/x-icon" href="poze/logo-teastore.png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/editTea.css">
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
    <br>
    <h1>Edit Tea</h1>
    <br>
    <form action="edit_tea.php" class="form-edit-tea" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"
                   value="<?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description"
                   value="<?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price"
                   value="<?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity"
                   value="<?php echo htmlspecialchars($product['quantity'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
        <div>
            <label for="state">State:</label>
            <select name="state" id="state">
                <option value="active" <?php if ($product['is_active'] === 'active') echo 'selected'; ?>>Active</option>
                <option value="inactive" <?php if ($product['is_active'] === 'inactive') echo 'selected'; ?>>Inactive
                </option>
            </select>
        </div>
        <br>
        <button type="submit">Update Tea</button>
    </form>
</div>
<br>
<br>
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
