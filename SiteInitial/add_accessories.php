
<?php
global  $cnx;
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($cnx, $_POST['name']);
    $description = mysqli_real_escape_string($cnx, $_POST['description']);
    $quantity = mysqli_real_escape_string($cnx, $_POST['quantity']);
    $state = mysqli_real_escape_string($cnx, $_POST['state']);
    $price = mysqli_real_escape_string($cnx, $_POST['price']); 

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    } else {
        $imgContent = null;
    }

    mysqli_begin_transaction($cnx);

    try {
        $sql_product = "INSERT INTO product_accessories (product_name, description, quantity, picture, product_link, is_active, price, created_date, updated_date) 
                        VALUES ('$name', '$description', '$quantity', '$imgContent', '#', '$state', '$price', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";

        if (!mysqli_query($cnx, $sql_product)) {
            throw new Exception("Error inserting into product table: " . mysqli_error($cnx));
        }

        $product_id = mysqli_insert_id($cnx);

        $sql_inventory = "INSERT INTO product_inventory_accessories (product_id, quantity,  created_date, updated_date) 
                          VALUES ('$product_id', '$quantity',  CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";

        if (!mysqli_query($cnx, $sql_inventory)) {
            throw new Exception("Error inserting into product_inventory_accessories table: " . mysqli_error($cnx));
        }

        mysqli_commit($cnx);

        echo "New accessories added successfully!";
    } catch (Exception $e) {
        mysqli_rollback($cnx);
        echo $e->getMessage();
    }

    mysqli_close($cnx);
}
