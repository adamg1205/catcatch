<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ChatPulse — Code d'accès</title>
<link rel="icon" type="image/svg+xml" href="logo.png" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
  body{ margin:0; font-family:'Inter',sans-serif; background:#07090b; color:#e6edf3; display:flex; justify-content:center; align-items:center; height:100vh; overflow:hidden; position:relative; }
  .container{ text-align:center; max-width:600px; padding:28px; z-index:1; position:relative; }
  h1{ font-size:2.4rem; margin-bottom:14px; }
  p.lead{ color:#92a1b2; margin-bottom:22px; }
  .card{ background:rgba(255,255,255,0.03); padding:26px; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,0.6); }

  .code-input{ display:flex; gap:10px; justify-content:center; margin:18px 0 6px; }
  .code-input input{ width:64px; height:64px; border-radius:12px; border:1px solid rgba(255,255,255,0.06); background:transparent; color:inherit; font-size:1.8rem; text-align:center; caret-color:transparent; outline:none; }
  .hint{ color:#9fb0c9; font-size:0.9rem; margin-top:12px; }

  .btn{ margin-top:16px; padding:12px 24px; font-weight:700; border-radius:999px; background:linear-gradient(135deg,#1d9bf0,#7c3aed); border:none; color:#fff; font-size:1rem; cursor:pointer; transition:.18s; display:inline-block; }
  .btn:hover{ filter:brightness(1.04); transform:translateY(-2px); }

  .error{ color:#ffb4b4; margin-top:10px; }
  .success{ color:#a8ffd1; margin-top:10px; }

  .bg-cats{ position:absolute; top:0; left:0; width:100%; height:100%; overflow:hidden; z-index:0; pointer-events:none; }
  .cat{ position:absolute; font-size:2.5rem; opacity:0.06; animation: float 12s infinite linear; }
  @keyframes float{ from{ transform:translateY(100vh) rotate(0deg); } to{ transform:translateY(-120px) rotate(360deg); } }

  @media(max-width:420px){ .code-input input{ width:52px; height:52px; font-size:1.4rem; } h1{ font-size:1.8rem; } }
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
      <h1>Crée ton code à 4 chiffres</h1>
      <p class="lead">Choisis un code PIN que tu utiliseras pour accéder à ton espace ChatPulse.</p>

      <form id="pinForm" method="POST" action="save_pin.php" autocomplete="off">
  <input type="hidden" name="codepin" id="codepin">

  <div class="code-input" id="codeBoxes">
    <input inputmode="numeric" maxlength="1" class="digit" />
    <input inputmode="numeric" maxlength="1" class="digit" />
    <input inputmode="numeric" maxlength="1" class="digit" />
    <input inputmode="numeric" maxlength="1" class="digit" />
  </div>

  <button class="btn" id="submitBtn" type="button">Enregistrer</button>
  <div id="msg"></div>
</form>

<!-- Bouton Se connecter si déjà un compte -->
<a href="loginpin.php" class="btn" style="margin-top:12px; display:inline-block; background:linear-gradient(135deg,#4ade80,#22d3ee);">
  J'ai déjà un compte
</a>

<p class="hint">Astuce :  Utilise un code que tu utilises déjà (de ton téléphone, My eyes only...) pour ne pas l'oublier.</p>

      </form>
    </div>
  </div>

<script>
  const inputs = Array.from(document.querySelectorAll('.digit'));

  inputs.forEach((inp, idx) => {
    inp.addEventListener('input', (e) => {
      const v = e.target.value.replace(/[^0-9]/g, '');
      e.target.value = v;
      if(v && idx < inputs.length - 1) inputs[idx + 1].focus();
      updateMessage('');
    });
    inp.addEventListener('keydown', (e) => {
      if(e.key === 'Backspace' && !e.target.value && idx > 0){ inputs[idx - 1].focus(); }
      if(!/^[0-9]$/.test(e.key) && e.key.length === 1){ e.preventDefault(); }
    });
  });

  function getPin(){ return inputs.map(i => i.value).join(''); }

  function updateMessage(text, cls){
    const msg = document.getElementById('msg');
    msg.textContent = text;
    msg.className = cls || '';
  }

  document.getElementById('submitBtn').addEventListener('click', () => {
    const pin = getPin();

    if(pin.length !== 4){
      updateMessage("Merci d'entrer un code à 4 chiffres.", 'error');
      return;
    }

    document.getElementById('codepin').value = pin;
    document.getElementById('pinForm').submit();
  });

  document.getElementById('codeBoxes').addEventListener('click', () => {
    const firstEmpty = inputs.find(i => !i.value) || inputs[inputs.length - 1];
    firstEmpty.focus();
  });

  window.addEventListener('load', () => inputs[0].focus());
</script>
</body>
</html>