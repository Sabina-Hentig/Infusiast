
<?php
session_start();
include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        die("Passwords do not match.");
    }

    $hashed_password = md5($new_password);

    $stmt = $cnx->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        echo "Password successfully reset.";
    } else {
        echo "Error updating password: " . $stmt->error;
    }

    $stmt->close();
    $cnx->close();
}
?>

