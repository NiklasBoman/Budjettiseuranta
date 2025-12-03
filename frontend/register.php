<!doctype html>
<html>
<head>
<title>Kirjaudu sisään</title>
<link rel="stylesheet" href="logintyyli.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../frontend/assets/style.css">
</head>
<body>

<div class="container">
    <img src="../frontend/assets/joululakki.png" alt="Joululakki" class="joululakki">
    <!-- Kirjautumislomake, joka lähettää tiedot login.php:lle POST-metodilla -->
    <div class="vasen-paneeli">
    <h2>Jatka rekisteröitymällä!</h2>
    <p>Luo tili ja koe moderni budjetin seuranta</p>
    </div>
    <div class="oikea-paneeli">
 <form action="login.php" method="post">
        <!-- Lomakkeen otsikko -->
<h2>Rekisteröityminen</h2>
    <br>
    
    <label>Nimi</label>
    <input type="text" name="nimi" id="nimi" placeholder="Etunimi Sukunimi" required>
    <br>
    <label>Sähköposti</label>
    <input type="email" name="gmail" id="gmail" placeholder="nimi@example.com" required>
    <br>
    <label>Salasana</label>
    <input type="password" name="salasana" id="salasana" placeholder="salasana" required>
<div class="login-container">
    <a href="login.php" class="login-link">Kirjautumaan</a>
</div>
<br>
    <button type="submit">Rekisteröidy</button>
</form>
    </form>
    </div>
</div>
<div class="Lumi-maa"></div>
   <div class="lumi">
        <div class="snowflake lumihiutale1">❅</div>
        <div class="snowflake lumihiutale2">❆</div>
        <div class="snowflake lumihiutale3">❅</div>
        <div class="snowflake lumihiutale4">❅</div>
        <div class="snowflake lumihiutale5">❆</div>
        <div class="snowflake lumihiutale6">❅</div>
    </div>
</body>
</html>

