
<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $quantity = $_POST['quantity'];

    $query = "UPDATE orders SET quantity = $quantity, updated_date = NOW() WHERE id = $order_id";
    $result = mysqli_query($cnx, $query);

    if ($result) {
        header("Location: basket.php");
    } else {
        die("Quantity update failed: " . mysqli_error($cnx));
    }
}

mysqli_close($cnx);
?>
