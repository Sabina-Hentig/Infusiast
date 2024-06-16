
<?php
global  $cnx;
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($cnx, $_POST['name']);
    $description = mysqli_real_escape_string($cnx, $_POST['description']);
    $quantity = mysqli_real_escape_string($cnx, $_POST['quantity']);
    $id_category_1 = mysqli_real_escape_string($cnx, $_POST['category']);
    $id_category_2 = mysqli_real_escape_string($cnx, $_POST['type']);
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
        $sql_product = "INSERT INTO product (product_name, description, quantity, id_category_1, id_category_2, picture, product_link, is_active, price, created_date, updated_date) 
                        VALUES ('$name', '$description', '$quantity', '$id_category_1', '$id_category_2', '$imgContent', '#', '$state', '$price', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";

        if (!mysqli_query($cnx, $sql_product)) {
            throw new Exception("Error inserting into product table: " . mysqli_error($cnx));
        }

        $product_id = mysqli_insert_id($cnx);

        $unit_of_measure = 'units';
        if (strpos($quantity, 'g') !== false) {
            $unit_of_measure = 'grams';
        } elseif (strpos($quantity, 'bags') !== false) {
            $unit_of_measure = 'bags';
        }

        $sql_inventory = "INSERT INTO product_inventory (product_id, quantity, unit_of_measure, created_date, updated_date) 
                          VALUES ('$product_id', '$quantity', '$unit_of_measure', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";

        if (!mysqli_query($cnx, $sql_inventory)) {
            throw new Exception("Error inserting into product_inventory table: " . mysqli_error($cnx));
        }

        mysqli_commit($cnx);

        echo "New tea added successfully!";
    } catch (Exception $e) {
        mysqli_rollback($cnx);
        echo $e->getMessage();
    }

    mysqli_close($cnx);
}

