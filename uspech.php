<!doctype html>
<html lang="en">
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link>
    <link rel="stylesheet" href="style/global.css" type="text/css" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
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
