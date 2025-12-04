<?php
session_start();
include '../backend/db.php'; // Yhteys tietokantaan

$error = "";

// Käsitellään lomakkeen lähetys
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nimi = trim($_POST['nimi'] ?? '');
    $gmail = trim($_POST['gmail'] ?? '');
    $salasana = $_POST['salasana'] ?? '';

    $virheet = [];

    // Tarkistetaan, että kaikki kentät on täytetty
    if (empty($nimi) || empty($gmail) || empty($salasana)) {
        $virheet[] = "Kaikki kentät ovat pakollisia.";
    }

    // Sähköpostin validointi
    if (!empty($gmail) && !filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        $virheet[] = "Sähköposti ei ole kelvollinen.";
    }

    // Tarkistetaan onko sähköposti jo rekisteröity
    if (empty($virheet)) {
        $stmt_check = $conn->prepare("SELECT userid FROM users WHERE email = ?");
        if (!$stmt_check) {
            $virheet[] = "Tietokantavirhe: " . $conn->error;
        } else {
            $stmt_check->bind_param("s", $gmail);
            $stmt_check->execute();
            $stmt_check->store_result();

            if ($stmt_check->num_rows > 0) {
                $virheet[] = "Sähköposti on jo käytössä. Valitse toinen.";
            }
            $stmt_check->close();
        }
    }

    // Lisätään käyttäjä tietokantaan
    if (empty($virheet)) {
        $hash = password_hash($salasana, PASSWORD_DEFAULT);

        // Huom: lisätään 'status' sarakkeeseen 'active'
        $stmt = $conn->prepare("INSERT INTO users (name, email, passwordhash, status) VALUES (?, ?, ?, 'active')");
        if (!$stmt) {
            $virheet[] = "Tietokantavirhe: " . $conn->error;
        } else {
            $stmt->bind_param("sss", $nimi, $gmail, $hash);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Rekisteröinti onnistui! Voit nyt kirjautua sisään.";
                header("Location: login.php");
                exit;
            } else {
                $virheet[] = "Rekisteröinti epäonnistui: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
?>
<!doctype html>
<html>
<head>
<title>Register</title>
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
    <h2>Jatka rekisteröitymällä!</h2>
    <p>Luo tili ja koe moderni budjetin seuranta</p>
    
    </div>
    <div class="oikea-paneeli">
 <form action="" method="post">
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

