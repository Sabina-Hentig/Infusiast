
<?php
$cnx = mysqli_connect("localhost", "root", "", "infusiast4");
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($cnx, "utf8");
?>