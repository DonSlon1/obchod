<!doctype html>
<html lang="cs">
<head>
    <meta http-equiv="refresh" content="5;url=/">
    <meta name="description" content="Košík">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="images/icon-apple.png">
    <link rel="manifest" href="manifest.json"/>

    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"
          crossorigin="anonymous">

    <link>
    <link rel="stylesheet" href="style/global.css" type="text/css" crossorigin="anonymous">

    <script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>


    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>
</head>
<body>
<?php
const MyConst = true;

require "pomoc/navigace.php";
require "pomoc/funkce.php";

navigace();


?>
<div class="container" style="text-align: center ; font-weight: 700;font-size: 30px">
    Vaše objednávka byla úspěšně odeslána
</div>
<script type="text/javascript" src="/js/global_funcion.js"></script>
<script type="text/javascript" src="/js/login.js"></script>
</body>
