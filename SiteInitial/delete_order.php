
<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];

    $query = "DELETE FROM orders WHERE id = $order_id";
    $result = mysqli_query($cnx, $query);

    if ($result) {
        header("Location: basket.php");
    } else {
        die("Order deletion failed: " . mysqli_error($cnx));
    }
}

mysqli_close($cnx);
?>
