<?php
session_start();
include 'bdd.php'; // connexion mysqli

if(isset($_POST['codepin'])){
    $codepin = $_POST['codepin'];

    // Sécurité : 4 chiffres
    if(!preg_match('/^[0-9]{4}$/', $codepin)){
        $_SESSION['flash_error'] = 'Code PIN invalide. 4 chiffres obligatoires.';
        header('Location: register_pin.php');
        exit;
    }

    // Préparer la requête
    $stmt = $conn->prepare("INSERT INTO codepin (code) VALUES (?)");
    $stmt->bind_param("s", $codepin);

    if($stmt->execute()){
        $_SESSION['flash_success'] = 'Code PIN enregistré ! Tu peux maintenant te connecter.';
        header("Location: loginpin.php");
        exit;
    } else {
        $_SESSION['flash_error'] = "Erreur SQL : " . $stmt->error;
        header("Location: register_pin.php");
        exit;
    }

    $stmt->close();
} else {
    $_SESSION['flash_error'] = 'Aucun code reçu.';
    header("Location: register_pin.php");
    exit;
}

$conn->close();
?>
