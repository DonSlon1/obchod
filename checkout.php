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
            <a href="basket.php">
                <span>Košík</span>
            </a>
        </li>
        <li class="active_li">
            <a>
                <span>Doprava a pladba</span>
            </a>
        </li>
        <li>
            <a>
                <span>Souhrn objednávky</span>
            </a>
        </li>
    </ul>

    <form class="cont preventDefault">
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
            <h2>Košík</h2>
            <?php
                $cena_celkem = 0;
                foreach ($form_data as $item) {
                    $cena_celkem = $item["Cena"] * $item["pocet"];

                    echo('
                        <div>
                            <a class="obrazek" href="produkt?ID_P='.$item["ID_P"].'">
                                <img alt="'.htmlspecialchars($item["Nazev"]).'" src="images/'.$item["Obrazek"].'">
                            </a>
                            <h3>');
                    if ($item["pocet"] != 1) {
                        echo $item["pocet"].'×';
                    }
                    echo(' <a href="produkt?ID_P='.$item["ID_P"].'" >'.$item["Nazev"].'</a></h3>
                        <div class="cena">
                            '.number_format($item["Cena"] * $item["pocet"], thousands_separator: ' ').' Kč
                        </div>
                        </div>
                        ');

                }
            ?>
            <div class="info-objednavka">
                <div id="doprava-kosik" class="plat_kosik">

                </div>
                <div id="platba-kosik" class="plat_kosik">

                </div>
                <div class="cena-celkem">
                    <span>Celkem:</span>
                    <span class="strong"><?php echo(number_format($cena_celkem, thousands_separator: ' ').' Kč') ?></span>
                </div>
            </div>
        </div>
        <div class="bottom">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid dicta error, expedita in incidunt nesciunt
            officiis perspiciatis possimus provident qui quia quibusdam reprehenderit repudiandae tempora unde
            voluptatem voluptates voluptatibus? Facere.
        </div>
    </form>
</div>

<script src="service-worker.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
