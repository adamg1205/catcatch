<?php
session_start();
include 'bdd.php';

// Vérification qu'on est connecté via session (exemple basique)
if (!isset($_SESSION['user_id'])) {
    header('Location: loginpin.php');
    exit;
}

// Récupérer le prénom depuis la BDD
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT prenom FROM maz WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($prenom);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ChatPulse — Bienvenue</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
body{
  margin:0; font-family:'Inter',sans-serif; background:#07090b; color:#e6edf3;
  display:flex; justify-content:center; align-items:center; height:100vh; text-align:center; overflow:hidden; position:relative;
}
.container{ max-width:600px; padding:28px; z-index:1; position:relative; }
h1{ font-size:2.5rem; margin-bottom:16px; }
p.lead{ color:#92a1b2; margin-bottom:24px; font-size:1.1rem; }

.btn{
  margin-top:20px; padding:14px 28px; font-weight:700; border-radius:999px;
  background:linear-gradient(135deg,#1d9bf0,#7c3aed); border:none; color:#fff; font-size:1.1rem;
  cursor:pointer; transition:.2s;
}
.btn:hover{ filter:brightness(1.05); transform:translateY(-2px); }

.bg-cats{ position:absolute; top:0; left:0; width:100%; height:100%; overflow:hidden; z-index:0; pointer-events:none; }
.cat{ position:absolute; font-size:2.5rem; opacity:0.06; animation: float 12s infinite linear; }
@keyframes float{ from{ transform:translateY(100vh) rotate(0deg); } to{ transform:translateY(-120px) rotate(360deg); } }
</style>
</head>
<body>

<div class="bg-cats">
    <div class="cat" style="left:10%; animation-delay:0s;">🐱</div>
    <div class="cat" style="left:35%; animation-delay:2s;">😺</div>
    <div class="cat" style="left:55%; animation-delay:4s;">🐈</div>
    <div class="cat" style="left:75%; animation-delay:1s;">😻</div>
    <div class="cat" style="left:90%; animation-delay:3s;">🐾</div>
</div>

<div class="container">
    <h1>Bonjour <?= htmlspecialchars($prenom) ?> ! 👋</h1>
    <p class="lead">Le site est encore en construction, mais pour te divertir un peu :</p>
    
    <!-- Petit divertissement : GIF ou message fun -->
    <img src="https://media.giphy.com/media/JIX9t2j0ZTN9S/giphy.gif" alt="Chat qui danse" style="max-width:100%; border-radius:16px;">
    
    <p class="lead">Profite de ce petit chat dansant pendant que nous préparons ton espace ChatPulse 😺</p>

    <a href="index.php" class="btn">Se déconnecter</a>
</div>

</body>
</html>
