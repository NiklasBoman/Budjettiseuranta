<!doctype html>
<html lang="fi">
<?php 
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
<div class="content-wrapper">
<div class="teksticontainer">
<h1>Budjettiseuranta</h1>
<p class="trancation-teksti"> Seuraa talouttasi talven aikana</p>
</div>
<div class="isocontainer">
<div class="pienicontainer">
    <p class="trancation-teksti">Tulot</p>
    <!-- Sisältö tulee tähän -->
</div>
<div class="pienicontainer">
    <p class="trancation-teksti">Menot</p>
    <!-- Sisältö tulee tähän -->
</div>
<div class="pienicontainer">
    <p class="trancation-teksti">Saldo</p>
    <!-- Sisältö tulee tähän -->
</div>
</div>
</div>
<div class="container2">
    <h2>Tapahtumat</h2>
    <!-- Tapahtumien listaus tulee tähän -->
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