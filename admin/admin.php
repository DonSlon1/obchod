<!doctype html>
<html lang="cs">

<head>
    <meta name="description" content="admin-panel">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="/images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="/images/icon-apple.png">
    <link rel="manifest" href="/manifest.json"/>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"
          crossorigin="anonymous">

    <link>
    <link rel="stylesheet" href="/style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/tabulka-obrazek.css" type="text/css" crossorigin="anonymous">


    <script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>


    <title>Document</title>
</head>
<body>
<?php
const MyConst = true;
require "../pomoc/funkce.php";
require "../pomoc/navigace.php";
overeni_uzivatele();
navigace(0);

?>
<div class="d-flex flex-column">
    <a href="zadani-souboru.php">zadnání předmětu</a>
    <a href="prehled-produktu.php">přehled předmětu</a>
    <a href="recenze-uprava.php">přehled recenzí</a>
    <a href="objednavka.php">přehled objednávek</a>
</div>
</body>
<script type="text/javascript" src="/js/global_funcion.js"></script>
<script type="text/javascript" src="/js/login.js"></script>
</html>