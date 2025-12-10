<!doctype html>
<html lang="fi">
<?php 
session_start();
include '../backend/db.php'; 

$userid = $_SESSION["userid"];
//hakee tulot     
$stmt = $conn->prepare("SELECT SUM(tulo) FROM tapahtumat WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($tulot);
$stmt->fetch();
$stmt->close();
$tulot = $tulot ?? 0;

//hakee menot

$stmt = $conn->prepare("SELECT SUM(Menot) FROM tapahtumat WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($menot);
$stmt->fetch();
$stmt->close();
$menot = $menot ?? 0;

//laskee saldon
$saldo = $tulot - $menot;

//Haetaan käyttäjän tapahtumat
$tapahtumat = [];

//Näytetään tapahtumat päivä järjestyksessä
$stmt = $conn->prepare("
    SELECT kuvaus, tulo, Menot, paivamaara, kategoria
    FROM tapahtumat
    WHERE userid = ?
    ORDER BY paivamaara DESC 
");

$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $tapahtumat[] = $row;
}
$stmt->close();

$userid = $_SESSION["userid"];

if (isset($_POST['lisaa_tapahtuma'])) {
    $kuvaus = trim($_POST['kuvaus'] ?? '');
    $tyyppi = $_POST['tyyppi'] ?? 'tulo';
    $summa = floatval($_POST['summa'] ?? 0);
    $paivamaara = $_POST['paivamaara'] ?? date('Y-m-d');
    $kategoria = $_POST['kategoria'] ?? 'Muu';

    $tulo = 0;
    $menot = 0;

    if ($tyyppi === 'tulo') {
        $tulo = $summa;
    } else {
        $menot = $summa;
    }

    if ($kuvaus && ($tulo > 0 || $menot > 0)) {
        $stmt = $conn->prepare("INSERT INTO tapahtumat (userid, kuvaus, tulo, Menot, paivamaara, kategoria) VALUES (?, ?, ?, ?, ?, ?)"); //Lisätään tapahtuma tietokantaan 
        $stmt->bind_param("isddss", $userid, $kuvaus, $tulo, $menot, $paivamaara, $kategoria); 
        $stmt->execute();
        $stmt->close();

        header("Location: " . $_SERVER['PHP_SELF']); // Päivitä sivu
        exit;
    } else {
        $error_message = "Täytä kuvaus ja summa."; //Virheilmoitus jos kenttiä puuttuu
    }
}

?>
<head>
<title>Kategoriat</title>
<link rel="stylesheet" href="logintyyli.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../frontend/assets/style.css">
</head>
<body class="content">
    <?php require_once("includes/header.php"); //sisältää footer, header, css, bootstrap; ?>
<div class="teksticontainer">
<h1>Budjettiseuranta</h1>
<p class="trancation-teksti"></p>
</div>
<div class="isocontainer">
<div class="pienicontainer tulot">
    <p class="trancation-teksti">Tulot</p>
    <p class="summa"><?= number_format($tulot, 2, ",", " ") ?> €</p>
</div>
<div class="pienicontainer menot">
    <p class="trancation-teksti">Menot</p>
    <p class="summa"><?= number_format($menot, 2, ",", " ") ?> €</p>
</div>
<div class="pienicontainer saldo">
    <p class="trancation-teksti">Saldo</p>
    <p class="summa"><?= number_format($saldo, 2, ",", " ") ?> €</p>
</div>
</div>
<div class="container2">
  <div class="vasen-container">
    <!-- tähän vasemmalle esim. tapahtumat -->
  </div>

  
      </form>
      <form method="post" action="kategoriat.php">
      <button type="submit" name="kategoriat">Kategoriat</button>
    </form>
  </div>
</div>







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
<?php
if(!isset($_SESSION["userid"])){
    header("Location: logout.php");
    exit;
}
?>
</body>
</html>