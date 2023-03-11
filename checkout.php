<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/product.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          crossorigin="anonymous">
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
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    $form_data = $_SESSION["form_data"]["polozka"];
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
    <div class="cont">
        <div>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium animi aut, dolorem esse eum,
            facere id iure non porro quaerat soluta? Delectus exercitationem in, magnam obcaecati odio pariatur porro!
        </div>
        <div class="kosik">
            <h2>Košík</h2>
            <?php
                foreach ($form_data as $item) {


                    echo('
                        <div>
                            <a class="obrazek" href="produkt?ID_P='.$item["ID_P"].'">
                                <img src="images/'.$item["Obrazek"].'">
                            </a>
                            <h3>');
                    if ($item["pocet"] != 0) {
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

        </div>
    </div>
</div>


<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script src="js/global_funcion.js"></script>
<script src="js/login.js"></script>
</body>
</html>
