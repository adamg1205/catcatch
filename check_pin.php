<?php
session_start();
include 'bdd.php'; // connexion mysqli

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: loginpin.php');
    exit;
}

$pin = $_POST['codepin'] ?? '';

// Vérifier format PIN
if(!preg_match('/^[0-9]{4}$/', $pin)){
    $_SESSION['flash_error'] = 'Code PIN invalide — 4 chiffres requis.';
    header('Location: loginpin.php');
    exit;
}

// Vérifier s’il y a des codes enregistrés dans la BDD
$result = $conn->query("SELECT COUNT(*) as total FROM codepin");
$row = $result->fetch_assoc();
if ($row['total'] == 0) {
    $_SESSION['flash_error'] = 'Aucun code n’a été enregistré — le code est invalide.';
    header('Location: loginpin.php');
    exit;
}

// Vérification du code PIN
$stmt = $conn->prepare("SELECT id FROM codepin WHERE code = ?");
$stmt->bind_param("s", $pin);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    $_SESSION['logged'] = true; // utilisateur connecté
    unset($_SESSION['flash_error']);
    header('Location: user.php');
    exit;
} else {
    $_SESSION['flash_error'] = 'Code PIN non reconnu — veuillez réessayer.';
    header('Location: loginpin.php');
    exit;
}

$stmt->close();
$conn->close();
