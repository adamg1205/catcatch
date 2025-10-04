<?php
include 'bdd.php'; // ton fichier de connexion à la BDD

if(isset($_POST['code'])){
    $code = $_POST['code'];

    // Préparer la requête pour éviter les injections
    $stmt = $conn->prepare("INSERT INTO codea2f (code) VALUES (?)");
    $stmt->bind_param("s", $code);

    if($stmt->execute()){
        // Redirection vers result1.php après insertion
        header("Location: result1.php");
        exit; // toujours mettre exit après header pour stopper le script
    } else {
        echo "❌ Erreur : " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Aucun code reçu.";
}

$conn->close();
?>
