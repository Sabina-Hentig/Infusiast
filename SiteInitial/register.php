
<?php
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = md5($password);
    $user_type = 'client';


    $stmt = $cnx->prepare("INSERT INTO users (name, lastname, email, user_type ,password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $lastname, $email, $user_type, $hashed_password);

    if ($stmt->execute()) {
        echo "New record created successfully";
        sleep(3);
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $cnx->close();
}
?>