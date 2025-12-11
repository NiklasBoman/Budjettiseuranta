<?php
    session_start();
include '../backend/db.php'; // Yhteys tietokantaan
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gmail = $_POST['gmail'] ?? '';
    $salasana = $_POST['salasana'] ?? '';

    // Valmistellaan kysely
    $stmt = $conn->prepare("SELECT userid, name, email, passwordhash, status FROM users WHERE email = ?");
    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Määritellään muuttujat ennen bind_result-kutsua
$kayttajaID = null;
$nimi = null;
$gmail_db = null;
$hash = null;
$status = null;

$stmt->bind_result($kayttajaID, $nimi, $gmail_db, $hash, $status);
        $stmt->fetch();

        if (password_verify($salasana, $hash)) {
            // Luodaan uusi sessiotunniste turvallisuussyistä (estää session fixation)
            // ja poistetaan vanha sessiotiedosto.
            session_regenerate_id(true);
            
            // Tallennetaan käyttäjän tiedot sessioon
            $_SESSION['userid'] = $kayttajaID;
            $_SESSION['name'] = $nimi;
            $_SESSION['email'] = $gmail_db;
            $_SESSION['status'] = $status; // Tallennetaan status sessioon

            if (isset($_POST['remember_me'])) {

    // Luodaan satunnainen token (64 merkkiä)
    $token = bin2hex(random_bytes(32));

    // Tallennetaan token tietokantaan käyttäjälle
    $stmt2 = $conn->prepare("UPDATE users SET remember_token = ? WHERE userid = ?");
    $stmt2->bind_param("si", $token, $kayttajaID);
    $stmt2->execute();
    $stmt2->close();

    // Tallennetaan token evästeeseen 30 päiväksi
    setcookie("remember_token", $token, time() + (86400 * 30), "/", "", false, true);
} else {
    // Poista eväste jos ei valittu
    setcookie("remember_token", "", time() - 3600, "/", "", false, true);
}

            // Ohjataan käyttäjä roolin perusteella oikealle sivulle
            if ($status === 'deleted') {
                print("❌ Tilisi on poistettu. Ota yhteyttä tukeen.");
            } else {
                header("Location: transactions.php");
            }
            exit;
        } else {
            $error = "❌ Väärä salasana.";  //Jos salasana väärin annetaan virhe.
        }
    } else {
        $error = "❌ Käyttäjätunnusta ei löytynyt."; //Sama juttu jos käyttäjätunnus ei löydy tietokannasta.
    }
    $stmt->close();
}
?>
<!doctype html>
<html lang="fi">
<head>
<title>Kirjaudu sisään</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../frontend/assets/style.css">
</head>
<body class="login">
 
<div class="container">
    <img src="../frontend/assets/joululakki.png" alt="Joululakki" class="joululakki">
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

        <!-- Kirjautumispainike ok -->
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
        <div class="snowflake lumihiutale7">❅</div>
        <div class="snowflake lumihiutale8">❅</div>
        <div class="snowflake lumihiutale9">❆</div>
    </div>
</body>
</html>