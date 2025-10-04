<?php
// db.php
$host = "catchcat-db";     // ou l'IP de ton serveur MySQL
$user = "root";          // ton utilisateur MySQL
$pass = "root";              // ton mot de passe MySQL
$db   = "catcatch";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>