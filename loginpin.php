<?php
session_start();
$errorMsg = $_SESSION['flash_error'] ?? '';
$successMsg = $_SESSION['flash_success'] ?? '';
unset($_SESSION['flash_error'], $_SESSION['flash_success']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Connexion — Code PIN</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
  body{margin:0;font-family:'Inter',sans-serif;background:#07090b;color:#e6edf3;display:flex;justify-content:center;align-items:center;height:100vh;}
  .container{ text-align:center; max-width:600px; padding:20px; }
  h1{ font-size:2.5rem; margin-bottom:20px; }
  p{ color:#92a1b2; margin-bottom:30px; }
  .error{ color:#ff4d4d; font-weight:600; margin-bottom:20px; font-size:1.1rem; }
  .success{ color:#a8ffd1; font-weight:600; margin-bottom:20px; font-size:1.1rem; }
  .pin-inputs{ display:flex; justify-content:center; gap:14px; }
  .pin-input{ width:60px; height:60px; border-radius:12px; border:none; font-size:2rem; text-align:center; background:#111418; color:#e6edf3; outline:none; transition:.2s; }
  .pin-input:focus{ box-shadow:0 0 0 2px #1d9bf0; }
  .btn{ margin-top:35px; padding:14px 28px; font-weight:700; border-radius:999px; background:linear-gradient(135deg,#1d9bf0,#7c3aed); border:none; color:#fff; font-size:1.1rem; cursor:pointer; transition:.2s; }
  .btn:hover{ filter:brightness(1.05); transform:translateY(-2px); }
</style>
</head>
<body>

<div class="container">
  <h1>Connexion</h1>
  <p>Entre ton code PIN à 4 chiffres pour continuer.</p>

  <?php if($errorMsg): ?>
    <div class="error"><?= htmlspecialchars($errorMsg) ?></div>
  <?php endif; ?>

  <?php if($successMsg): ?>
    <div class="success"><?= htmlspecialchars($successMsg) ?></div>
  <?php endif; ?>

  <form id="loginForm" method="POST" action="check_pin.php" autocomplete="off">
    <input type="hidden" name="codepin" id="codepin">
    <div class="pin-inputs" id="pinInputs">
      <input maxlength="1" class="pin-input" id="d1" name="d1" inputmode="numeric">
      <input maxlength="1" class="pin-input" id="d2" name="d2" inputmode="numeric">
      <input maxlength="1" class="pin-input" id="d3" name="d3" inputmode="numeric">
      <input maxlength="1" class="pin-input" id="d4" name="d4" inputmode="numeric">
    </div>
    <button class="btn">Connexion</button>
  </form>
</div>

<script>
const inputs = document.querySelectorAll('.pin-input');
const hidden = document.getElementById('codepin');

// focus automatique après petit délai
window.addEventListener('load', () => {
  setTimeout(() => {
    const firstEmpty = [...inputs].find(i => !i.value) || inputs[0];
    firstEmpty.focus();
  }, 50);
});

// navigation auto et suppression des non-chiffres
inputs.forEach((inp, idx) => {
  inp.addEventListener('input', () => {
    inp.value = inp.value.replace(/[^0-9]/g,'');
    if(inp.value.length === 1 && idx < inputs.length-1) inputs[idx+1].focus();
  });
  inp.addEventListener('keydown', (e) => {
    if(e.key === 'Backspace' && !inp.value && idx > 0) inputs[idx-1].focus();
  });
});

// click sur container → focus premier vide
document.getElementById('pinInputs').addEventListener('click', () => {
  const firstEmpty = [...inputs].find(i => !i.value) || inputs[inputs.length-1];
  firstEmpty.focus();
});

// remplir hidden au submit
document.getElementById('loginForm').addEventListener('submit', () => {
  hidden.value = [...inputs].map(i => i.value).join('');
});
</script>
</body>
</html>
