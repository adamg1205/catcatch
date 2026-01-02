<?php
session_start();
include 'bdd.php'; // connexion à ta BDD

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $prenom = trim($_POST['prenom'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $type_secret = trim($_POST['type_secret'] ?? '');
    $valeur_secret = trim($_POST['valeur_secret'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Vérifier que tous les champs sont remplis
    if (!$prenom || !$nom || !$type_secret || !$valeur_secret || !$password) {
        die("❌ Tous les champs sont obligatoires.");
    }

    // Préparer l'insertion
    $stmt = $conn->prepare("INSERT INTO maz (prenom, nom, type_secret, valeur_secret, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $prenom, $nom, $type_secret, $valeur_secret, $password);

    if ($stmt->execute()) {
        // Récupérer l'ID de l'utilisateur nouvellement créé
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id; // créer la session
        $_SESSION['prenom'] = $prenom;

        // Redirection vers la page connectée
        header("Location: home.php"); // la page “Bonjour [Prénom]”
        exit;
    } else {
        echo "❌ Erreur SQL : " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Aucune donnée reçue.";
}

$conn->close();
?>
