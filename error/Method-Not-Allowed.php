<!doctype html>
<html lang="cs">

<head>
    <meta http-equiv="refresh" content="5;url=/">
    <meta name="description" content="Dodaci udaje">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="/images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="/images/icon-apple.png">
    <link rel="manifest" href="/manifest.json"/>
    <link rel="stylesheet" href="/style/product.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="/style/global.css" type="text/css" crossorigin="anonymous">

    <title>Document</title>
</head>
<?php
const MyConst = true;

require "../pomoc/navigace.php";
navigace();
?>
<body>
<div class="container">
    <div class='error-kosik error-user'>
        <div>

            <span> Je nám líto, tato HTTP metoda zde není podporována.<br><b> Pokračujte na <a
                        href="/">úvodní stránku.</a></b></span>
        </div>
    </div>
</div>
</body>

<script src="/service-worker.js"></script>
<script src="/node_modules/axios/dist/axios.min.js"></script>
<script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
</html>
