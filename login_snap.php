<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion — Snapchat</title>
  <style>
    * { box-sizing: border-box; margin:0; padding:0; }
    body {
      background: #FFFC00;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      width: 100%;
      max-width: 380px;
      text-align: center;
    }
    .logo {
      width: 100px;
      height: auto;
      margin-bottom: 30px;
    }
    h1 {
      font-size: 26px;
      margin-bottom: 24px;
      font-weight: bold;
      color: #000;
    }
    .field {
      margin-bottom: 16px;
    }
    input {
      width: 100%;
      padding: 14px;
      font-size: 16px;
      border: none;
      border-radius: 25px;
      background: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    input:focus {
      outline: 2px solid #000;
    }
    .btn-login {
      width: 100%;
      padding: 14px;
      background: #000;
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      margin-top: 12px;
      transition: background 0.2s ease;
    }
    .btn-login:hover {
      background: #333;
    }
    .links {
      margin-top: 20px;
      font-size: 14px;
      color: #000;
    }
    .links a {
      display: block;
      margin-top: 6px;
      text-decoration: none;
      color: #000;
    }
    .links a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Logo fantôme -->
    <img class="logo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Snapchat_logo.svg/1200px-Snapchat_logo.svg.png" alt="Logo Snapchat">
    <h1>Se connecter</h1>
    <form action="#" method="post">
      <div class="field">
        <input type="text" name="username" placeholder="Nom d’utilisateur ou e-mail" required>
      </div>
      <div class="field">
        <input type="password" name="password" placeholder="Mot de passe" required>
      </div>
      <button class="btn-login" type="submit">Connexion</button>
    </form>
    <div class="links">
      <a href="#">Mot de passe oublié ?</a>
      <a href="#">S’inscrire</a>
    </div>
  </div>
</body>
</html>
