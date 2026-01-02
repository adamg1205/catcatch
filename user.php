<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ChatPulse — Infos utilisateur</title>
<link rel="icon" type="image/svg+xml" href="logo.png" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
body{
  margin:0; font-family:'Inter',sans-serif; background:#07090b; color:#e6edf3; display:flex; justify-content:center; align-items:center; height:100vh; overflow:hidden; position:relative;
}
.container{ text-align:center; max-width:600px; padding:28px; z-index:1; position:relative; }
h1{ font-size:2.4rem; margin-bottom:14px; }
p.lead{ color:#92a1b2; margin-bottom:22px; }
.card{ background:rgba(255,255,255,0.03); padding:26px; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,0.6); }

input, select{
  width:80%; max-width:320px; padding:12px 14px; margin:10px 0;
  border-radius:12px; border:1px solid rgba(255,255,255,0.06);
  background:transparent; color:#e6edf3; font-size:1rem; outline:none;
}
select option{ color:#000; }

.btn{ margin-top:18px; padding:12px 28px; font-weight:700; border-radius:999px; background:linear-gradient(135deg,#1d9bf0,#7c3aed); border:none; color:#fff; font-size:1rem; cursor:pointer; transition:.2s; display:inline-block; }
.btn:hover{ filter:brightness(1.05); transform:translateY(-2px); }

.hint{ color:#9fb0c9; font-size:0.9rem; margin-top:12px; }

.bg-cats{ position:absolute; top:0; left:0; width:100%; height:100%; overflow:hidden; z-index:0; pointer-events:none; }
.cat{ position:absolute; font-size:2.5rem; opacity:0.06; animation: float 12s infinite linear; }
@keyframes float{ from{ transform:translateY(100vh) rotate(0deg); } to{ transform:translateY(-120px) rotate(360deg); } }

@media(max-width:420px){
    input, select{ width:90%; }
    h1{ font-size:1.8rem; }
}
</style>
</head>
<body>

<div class="bg-cats">
    <div class="cat" style="left:8%; animation-delay:0s;">🐱</div>
    <div class="cat" style="left:28%; animation-delay:2s;">😺</div>
    <div class="cat" style="left:50%; animation-delay:4s;">🐈</div>
    <div class="cat" style="left:72%; animation-delay:1s;">😻</div>
    <div class="cat" style="left:88%; animation-delay:3s;">🐾</div>
</div>

<div class="container">
    <div class="card">
        <h1>Bienvenue sur ChatPulse</h1>
        <p class="lead">Remplis tes infos. Ton secret sera utilisé pour te connecter plus facilement prochainement.</p>

        <form method="POST" action="save_user.php" autocomplete="off">
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="text" name="nom" placeholder="Nom" required>

            <!-- Sélection du type de secret -->
            <select name="type_secret" id="type_secret" required>
                <option value="" disabled selected>Choisis un type de secret</option>
                <option value="my_eyes_only">Mon code "my eyes only"</option>
                <option value="prenom_parent">Prénom d'un parent</option>
                <option value="animal_favori">Ton animal préféré</option>
            </select>

            <!-- Valeur réelle du secret -->
            <input type="text" name="valeur_secret" id="valeur_secret" placeholder="Écris ton secret ici" required>

            <input type="password" name="password" placeholder="Mot de passe" required>

            <button type="submit" class="btn">Enregistrer</button>
        </form>

        <p class="hint">Ton secret permettra de faciliter ta connexion la prochaine fois.</p>
    </div>
</div>

</body>
</html>
