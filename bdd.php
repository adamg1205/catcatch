<?php
// db.php
$host = "localhost";
$db   = "catcatch";
$user = "root";
$pass = "root";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>