<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $user_id = 8; // Replace with the actual user ID from the session
    $order_number = rand(100000, 999999); // Generate a random order number

    // Check if the product is an accessory or a regular product
    $query = "SELECT id FROM product WHERE id = $product_id";
    $result = mysqli_query($cnx, $query);
    if (mysqli_num_rows($result) > 0) {
        $product_accessory_id = 'NULL';
    } else {
        $query = "SELECT id FROM product_accessories WHERE id = $product_id";
        $result = mysqli_query($cnx, $query);
        if (mysqli_num_rows($result) > 0) {
            $product_accessory_id = $product_id;
            $product_id = 'NULL';
        } else {
            die("Invalid product ID");
        }
    }

    $query = "INSERT INTO orders (order_number, product_id, user_id, product_accessory_id, created_date, updated_date)
              VALUES ('$order_number', $product_id, $user_id, $product_accessory_id, NOW(), NOW())";
    $result = mysqli_query($cnx, $query);

    if ($result) {
        header("Location: basket.php");
    } else {
        die("Order could not be placed: " . mysqli_error($cnx));
    }
}


mysqli_close($cnx);

?>
