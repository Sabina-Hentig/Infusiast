
<?php

include 'config/db.php';
// Check connection
if ($cnx->connect_error) {
    die("Connection failed: " . $cnx->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $cnx->real_escape_string($_POST['name']);
    $email = $cnx->real_escape_string($_POST['email']);
    $message = $cnx->real_escape_string($_POST['message']);

    // SQL query to insert data into contact_form table
    $sql = "INSERT INTO contact_form (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($cnx->query($sql) === TRUE) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $cnx->close();
}
?>
