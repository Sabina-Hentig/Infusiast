<?php
global $cnx;
include 'config/db.php';

$id = mysqli_real_escape_string($cnx, $_GET['id']);

mysqli_begin_transaction($cnx);

try {
    $sql_inventory = "DELETE FROM product_inventory WHERE product_id='$id'";
    if (!mysqli_query($cnx, $sql_inventory)) {
        throw new Exception("Error deleting from product_inventory: " . mysqli_error($cnx));
    }

    $sql_product = "DELETE FROM product WHERE id='$id'";
    if (!mysqli_query($cnx, $sql_product)) {
        throw new Exception("Error deleting from product: " . mysqli_error($cnx));
    }

    mysqli_commit($cnx);

    header("Location: index.php");
    exit();
} catch (Exception $e) {
    mysqli_rollback($cnx);
    echo $e->getMessage();
}

mysqli_close($cnx);
?>
