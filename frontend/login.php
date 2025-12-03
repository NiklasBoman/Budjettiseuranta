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
    <!-- Kirjautumislomake, joka lähettää tiedot login.php:lle POST-metodilla -->
    <div class="vasen-paneeli">
    <h2> Tervetuloa takaisin! </h2>
    <p>Kirjaudu sisään jatkaaksesi</p>
    </div>
    <div class="oikea-paneeli">
 <form action="login.php" method="post">
        <!-- Lomakkeen otsikko -->
        <h2>Kirjaudu sisään</h2>
        <br>

        <!-- Sähköpostikenttä -->
        <label>Sähköposti</label>
        <input type="email" name="gmail" id="gmail" placeholder="nimi@example.com" required>
        <br>

        <!-- Salasanakenttä -->
        <label>Salasana</label>
        <input type="password" name="salasana" id="salasana" placeholder="salasana" required>

        <div class="login-extra">
            <!-- Muista minut -valintaruutu -->
            <label class="remember-me">
                <input type="checkbox" id="remember_me" name="remember_me">
                Muista minut
            </label>

            <!-- Linkki rekisteröitymissivulle -->
            <a href="register.php" class="register-link">Rekisteröidy</a>
        </div>

        <!-- Kirjautumispainike -->
        <button type="submit">Kirjaudu</button>
        <br><br>
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
