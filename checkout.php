<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

const MyConst = true;
require "pomoc/funkce.php";
require "pomoc/connection.php";
overeni_kosik();
?>
<!doctype html>
<html lang="cs">
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
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="style/basket_nav.css">
    <link rel="stylesheet" href="style/checkout.css">
    <title>Document</title>
</head>
<body>
<?php


require "pomoc/navigace.php";
require "pomoc/doprava.php";
require "pomoc/platba.php";
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}


navigace(0);


$form_data = $_SESSION["form_data"]["polozka"];
$response_doprava = ziskat_dopravu();
$response_platba = ziskat_platbu();

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
                <a href="/" class="sede">Zpět do obchodu</a>
                <a href="dodaci-udaje" class="btn btn-primary btn-lg required" id="submit_checkout">Pokračovat v
                    objednávce
                </a>
            </div>
        </div>
    </form>
</div>

<script src="service-worker.js"></script>
<script src="/node_modules/axios/dist/axios.min.js"></script>
<script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>

<script src="/js/checkout.js"></script>
<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

</body>
</html>
