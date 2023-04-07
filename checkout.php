<!doctype html>
<html lang="en">
<head>
    <meta name="description" content="Košík">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="images/icon-apple.png">
    <link rel="manifest" href="manifest.json"/>
    <link rel="stylesheet" href="style/product.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="style/basket_nav.css">
    <link rel="stylesheet" href="style/checkout.css">
    <title>Document</title>
</head>
<body>
<?php

    const MyConst = true;

    require "pomoc/connection.php";
    require "pomoc/navigace.php";
    require "pomoc/doprava.php";
    require "pomoc/platba.php";
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    $form_data = $_SESSION["form_data"]["polozka"];
    $response_doprava = ziskat_dopravu();
    $response_platba = ziskat_platbu();

    navigace(0);


?>
<div class="container h_container  mt-5">
    <ul class="navigace">
        <li>
            <a href="basket.php" class="nepodtrh">
                <span>Košík</span>
            </a>
        </li>
        <li class="active_li">
            <a class="nepodtrh">
                <span>Doprava a pladba</span>
            </a>
        </li>
        <li>
            <a class="nepodtrh">
                <span>Souhrn objednávky</span>
            </a>
        </li>
    </ul>

    <form class="cont preventDefault" id="formular">
        <div class="moznosti">

            <div id="doprava" class="opions <?php if (array_key_exists("id_checked", $response_doprava)) {
                echo($response_doprava["id_checked"]);
            } ?>">
                <?php echo($response_doprava["html"]) ?>
            </div>
            <div id="platba" class="opions <?php if (array_key_exists("id_checked", $response_platba)) {
                echo($response_platba["id_checked"]);
            } ?>">
                <?php
                    if ($response_doprava["checked"]) {
                        echo($response_platba["html"]);
                    }
                ?>
            </div>

        </div>
        <div class="kosik">
            <?php
                require "pomoc/kosik.phtml"
            ?>
        </div>
        <div class="bottom">
            <div class="Checkout">
                <a href="obchod" class="sede">Zpět do obchodu</a>
                <a href="dodaci-udaje" class="btn btn-primary btn-lg required" id="submit_checkout">Pokračovat v
                    objednávce
                </a>
            </div>
        </div>
    </form>
</div>

<script src="service-worker.js"></script>
<script src="node_modules/axios/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="js/checkout.js"></script>
<script src="js/global_funcion.js"></script>
<script src="js/login.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

</body>
</html>
