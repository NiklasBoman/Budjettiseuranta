<!doctype html>
<html lang="fi">
<?php 
session_start();
include '../backend/db.php'; 

$userid = $_SESSION["userid"];
//tulot     
$stmt = $conn->prepare("SELECT SUM(tulo) FROM tapahtumat WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($tulot);
$stmt->fetch();
$stmt->close();
$tulot = $tulot ?? 0;

//Menot

$stmt = $conn->prepare("SELECT SUM(Menot) FROM tapahtumat WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($menot);
$stmt->fetch();
$stmt->close();
$menot = $menot ?? 0;

//Saldo
$saldo = $tulot - $menot;

//Haetaan käyttäjän tapahtumat
$tapahtumat = [];

$stmt = $conn->prepare("
    SELECT kuvaus, tulo, Menot, paivamaara 
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
    require_once("includes/header.php"); //sisältää footer, header, css, bootstrap

?>
<head>
<title>Transactions</title>
<link rel="stylesheet" href="logintyyli.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../frontend/assets/style.css">
</head>
<body class="content">
<div class="teksticontainer">
<h1>Budjettiseuranta</h1>
<p class="trancation-teksti"> Seuraa talouttasi talven aikana</p>
</div>
<div class="isocontainer">
<div class="pienicontainer">
    <p class="trancation-teksti">Tulot</p>
    <p class="summa"><?= number_format($tulot, 2, ",", " ") ?> €</p>
</div>
<div class="pienicontainer">
    <p class="trancation-teksti">Menot</p>
    <p class="summa"><?= number_format($menot, 2, ",", " ") ?> €</p>
</div>
<div class="pienicontainer">
    <p class="trancation-teksti">Saldo</p>
    <p class="summa"><?= number_format($saldo, 2, ",", " ") ?> €</p>
</div>
</div>
<div class="container2">
    <h2>Tapahtumat</h2>
<?php foreach ($tapahtumat as $t): ?>
    <div class="tapahtumarivi">
        <div>
            <strong><?= htmlspecialchars($t['kuvaus']) ?></strong><br>
            <small><?= $t['paivamaara'] ?></small>
        </div>

        <div class="tapahtuma-maara <?= $t['tulo'] ? 'tulo' : 'meno' ?>">
            <?= $t['tulo'] ? "+{$t['tulo']} €" : "-{$t['Menot']} €" ?>
        </div>
    </div>
<?php endforeach; ?>
    <button class="lisaa-tapahtuma-btn">Lisää</button>
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