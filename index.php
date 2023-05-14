<!doctype html>
<html lang="cs">
<head>
    <meta name="description" content="Produkt">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="images/icon-apple.png">
    <link rel="manifest" href="manifest.json"/>
    <title>Document</title>

    <link rel="stylesheet" href="style/product.css" type="text/css">

    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css" type="text/css">
    <link rel="stylesheet" href="style/hledat.css">
    <link rel="stylesheet" href="node_modules/nouislider/dist/nouislider.css">
    <script src="/node_modules/nouislider/dist/nouislider.min.js"></script>
    <script src="/service-worker.js"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>

    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>


</head>
<?php
    const MyConst = true;

    require "pomoc/connection.php";
    require "pomoc/navigace.php";
    require "pomoc/funkce.php";

    navigace();
    $conn = DbCon();


    $sql = 'SELECT p.ID_P AS  ID_P ,p.Nazev AS Nazev, Cena_Bez_DPH AS Cena , H_Obrazek,
        COALESCE(SUM(r.Hodnoceni) / COUNT(r.ID_R),0) AS Hodnocení, p.Popis AS Popis
        FROM predmety p
        LEFT JOIN recenze r on p.ID_P = r.ID_P
        GROUP BY p.ID_P';

    $predmety = mysqli_fetch_all(mysqli_execute_query($conn, $sql), ASSERT_ACTIVE);
    $predmetysave = array();
    foreach ($predmety as $item) {
        $predmetysave[] = array_map('htmlspecialchars', $item);
    }
?>

<div class="container h_container searchh">

    <div class="main-obsah">
        <?php
            foreach ($predmetysave as $item) {
                $cenna = number_format($item["Cena"], thousands_separator: ' ').' Kč';
                $hodnocei = $item["Hodnocení"] * 20;
                echo("
                <div class='predmet'>
            <a href='/produkt.php?ID_P={$item["ID_P"]}'>
                <div class='obrazek'>
                    <img src='images/{$item["H_Obrazek"]}' alt='{$item["Nazev"]}'>
                </div>

            </a>
            <div class='star-rating-wrapper hvezdy'>
                                    <div class='empty-stars-element'></div>
                                    <div class='stars-element' style='width:$hodnocei%'></div>
                                 </div>
            <div class='informace'>
                <a href='/produkt.php?ID_P={$item["ID_P"]}'>
                    <span class='nazev'>{$item["Nazev"]}</span>
                </a>
                <span class='cena-produkt'>$cenna</span>
            </div>
            <div class='popis'>
                {$item["Popis"]}
            </div>
        </div>");
            }

        ?>


    </div>
</div>

<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script src="/js/Add_To_cart.js"></script>

</html>

