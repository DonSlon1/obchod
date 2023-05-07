<!doctype html>
<html lang="cz">

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" crossorigin="anonymous"></script>
<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</html>
