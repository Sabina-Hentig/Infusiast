<?php
session_start();
global $cnx;
include "config/db.php";

function corectez($sir)
{
    $sir = trim($sir);
    $sir = stripslashes($sir);
    return htmlspecialchars($sir, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eroare = '';

    if (empty($_POST['email'])) {
        $eroare .= '<p>Nu ați introdus email-ul!</p>';
    } else {
        $email = corectez($_POST['email']);
    }

    if (empty($_POST['password'])) {
        $eroare .= '<p>Nu ați introdus parola!</p>';
    } else {
        $password = corectez($_POST['password']);
    }

    if ($eroare == '') {
        $stmt = $cnx->prepare("SELECT user_type, lastname FROM users WHERE email = ? AND password = ?");
        $hashed_password = md5($password);
        $stmt->bind_param("ss", $email, $hashed_password);

        if ($stmt->execute()) {
            $stmt->store_result();
            $rowcount = $stmt->num_rows;

            if ($rowcount != 0) {
                $stmt->bind_result($user_type, $lastname);
                $stmt->fetch();
                $_SESSION['conectat'] = true;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['user_type'] = $user_type;

                if ($user_type == 'client') {
                    header('Location: index.php');
                } else if ($user_type == 'admin') {
                    header('Location: adminLogged.php');
                }
                exit();
            } else {
                $eroare .= '<p>Email sau parolă incorectă!</p>';
            }
        } else {
            $eroare .= '<p>Eroare la executarea interogării!</p>';
        }
        $stmt->close();
    }

    if ($eroare != '') {
        echo "Eroare: " . $eroare;
    }
    $cnx->close();
}
