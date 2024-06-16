
<?php
global  $cnx;
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($cnx, $_POST['name']);
    $address = mysqli_real_escape_string($cnx, $_POST['address']);
    $city = mysqli_real_escape_string($cnx, $_POST['city']);

   
    mysqli_begin_transaction($cnx);

    try {
        $sql_address = "INSERT INTO client_address (full_name, client_address, city, placed_date) 
                        VALUES ('$name', '$address', '$city', CURRENT_TIMESTAMP())";

        if (!mysqli_query($cnx, $sql_address)) {
            throw new Exception("Error inserting into address table: " . mysqli_error($cnx));
        }

        mysqli_commit($cnx);

        echo "Order Placed!";
            
            sleep(3);
            
            header("Location: index.php");
        
    } catch (Exception $e) {
        mysqli_rollback($cnx);
        echo $e->getMessage();
    }

    mysqli_close($cnx);
       

}
