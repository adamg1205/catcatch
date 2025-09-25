<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>CatCatch — Découvre ton chat</title>
<link rel="icon" type="image/svg+xml" href="logo.png" />

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --bg:#07090b; --card:#0c1116; --muted:#96a3b3; --text:#e6edf3;
    --grad: linear-gradient(135deg,#1d9bf0,#7c3aed);
  }
  *{box-sizing:border-box}
  body{
    margin:0; min-height:100svh; display:grid; place-items:center;
    font-family:Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial;
    background: radial-gradient(1200px 800px at 70% -10%, #151a20 10%, transparent 60%) , var(--bg);
    color:var(--text);
  }
  .wrap{ width:min(680px,92vw); text-align:center; }
  h1{ font-weight:800; letter-spacing:.2px; margin:0 0 10px; }
  p.lead{ color:var(--muted); margin:0 0 28px; }

  /* Card */
  .card{
    background:linear-gradient(180deg, rgba(255,255,255,.02), rgba(255,255,255,0)) , var(--card);
    border:1px solid #1b2430; border-radius:22px; padding:28px;
    box-shadow:0 10px 40px rgba(0,0,0,.35);
  }

  /* Loader */
  .loader{
    display:inline-grid; place-items:center; gap:14px; padding:24px 10px;
    min-height:160px;
  }
  .spin{
    width:64px; height:64px; border-radius:50%;
    border:6px solid rgba(255,255,255,.12);
    border-top-color:#fff; animation:spin 1s linear infinite;
    filter:drop-shadow(0 0 14px rgba(124,58,237,.35));
  }
  @keyframes spin{ to { transform:rotate(360deg) } }
  .hint{ color:var(--muted); font-size:.95rem }

  /* Result */
  .result{ display:none; animation:pop .5s ease forwards }
  @keyframes pop{ from{ transform:translateY(6px); opacity:.0 } to{ transform:none; opacity:1 } }

  .badge{
    display:inline-block; padding:6px 12px; border-radius:999px;
    background:var(--grad); color:white; font-weight:700; letter-spacing:.3px;
    margin-bottom:12px;
  }
  .cat-emoji{ font-size:62px; margin:6px 0 10px }
  .cat-name{ font-size:1.8rem; font-weight:800; margin:6px 0 4px }
  .cat-desc{ color:var(--muted); margin:0 0 18px }

  .actions{ display:flex; justify-content:center; gap:12px; flex-wrap:wrap }
  .btn{
    appearance:none; border:0; cursor:pointer; font-weight:700;
    padding:12px 18px; border-radius:999px; transition:.18s ease;
  }
  .btn-primary{ background:var(--grad); color:#fff }
  .btn-primary:hover{ filter:brightness(1.05); transform:translateY(-1px) }
  .btn-ghost{ background:transparent; color:#c9d4e2; border:1px solid #2a3442 }
  .btn-ghost:hover{ background:#121821 }

  /* floating cats bg */
  .bg-cats{ position:fixed; inset:0; pointer-events:none; opacity:.14; overflow:hidden }
  .bg-cats span{ position:absolute; font-size:40px; animation:float 12s linear infinite }
  @keyframes float{ from{ transform:translateY(110%)} to{ transform:translateY(-20%)} }
</style>
</head>
<body>
  <!-- Fun background -->
  <div class="bg-cats" aria-hidden="true">
    <span style="left:8%; animation-delay:0s">🐱</span>
    <span style="left:24%; animation-delay:2s">😺</span>
    <span style="left:42%; animation-delay:1s">🐈</span>
    <span style="left:64%; animation-delay:3s">😻</span>
    <span style="left:82%; animation-delay:1.6s">🐾</span>
  </div>

  <main class="wrap">
    <h1>CatChat</h1>
    <p class="lead">On scanne tes vibes… prépare-toi à rencontrer ton alter-chat 🐈‍⬛</p>

    <section class="card" aria-live="polite">
      <!-- Loader -->
      <div class="loader" id="loader">
        <div class="spin" role="status" aria-label="Chargement"></div>
        <div class="hint">Analyse féline en cours (≈ 3 secondes)…</div>
      </div>

      <!-- Result -->
      <div class="result" id="result">
        <div class="badge">Ton totem félin</div>
        <div class="cat-emoji" id="catEmoji">😺</div>
        <div class="cat-name" id="catName">Chat Solaire</div>
        <p class="cat-desc" id="catDesc">Optimiste, curieux et toujours partant pour une sieste au soleil.</p>

        <div class="actions">
          <button class="btn btn-primary" id="againBtn">Rejouer</button>
          <button class="btn btn-ghost" id="shareBtn">Copier le résultat</button>
        </div>
      </div>
    </section>
  </main>

<script>
  // Liste des profils de chats
  const CATS = [
    { name: "Chat Solaire", emoji:"😺", desc:"Optimiste, curieux et toujours partant pour une sieste au soleil." },
    { name: "Ninja de Canapé", emoji:"🐱‍👤", desc:"Silencieux, furtif… surtout quand il s’agit d’éviter les tâches ménagères." },
    { name: "Chat Roi/Renne", emoji:"😼", desc:"Chic, exigeant, accepte les caresses… sur rendez-vous uniquement." },
    { name: "Tornade Poilue", emoji:"🐈", desc:"Énergie infinie, zoomies à 3h du matin, cœur tendre." },
    { name: "Philosophe Ronron", emoji:"🐱", desc:"Regarde la pluie en méditant sur le sens du thon." },
    { name: "Hacker de Croquettes", emoji:"😸", desc:"Trouve toujours une technique pour ouvrir le placard interdit." },
    { name: "Chat Nuage", emoji:"😻", desc:"Câlin, moelleux, météo intérieure : 100% ronron." },
    { name: "Explorateur du Frigo", emoji:"😹", desc:"Audacieux, intrépide, surtout quand la porte s’ouvre." }
  ];

  const loader = document.getElementById('loader');
  const result = document.getElementById('result');
  const catEmoji = document.getElementById('catEmoji');
  const catName  = document.getElementById('catName');
  const catDesc  = document.getElementById('catDesc');
  const againBtn = document.getElementById('againBtn');
  const shareBtn = document.getElementById('shareBtn');

  function pickRandomCat(){
    return CATS[Math.floor(Math.random() * CATS.length)];
  }

  function showResult(){
    const c = pickRandomCat();
    catEmoji.textContent = c.emoji;
    catName.textContent  = c.name;
    catDesc.textContent  = c.desc;
    loader.style.display = 'none';
    result.style.display = 'block';
  }

  // Première charge : 3 secondes de “scan”
  setTimeout(showResult, 3000);

  // Rejouer : on remet le loader 3s puis on révèle
  againBtn.addEventListener('click', () => {
    result.style.display = 'none';
    loader.style.display = 'inline-grid';
    setTimeout(showResult, 3000);
  });

  // Copier le résultat
  shareBtn.addEventListener('click', async () => {
    const text = `Mon totem félin : ${catName.textContent} ${catEmoji.textContent} — ${catDesc.textContent} #ChatPulse`;
    try{
      await navigator.clipboard.writeText(text);
      shareBtn.textContent = "Copié !";
      setTimeout(()=>shareBtn.textContent="Copier le résultat", 1500);
    }catch(e){
      alert("Impossible de copier, désolé :(");
    }
  });
</script>
</body>
</html>
