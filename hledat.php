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

$sql = 'SELECT MIN(Cena_Bez_DPH) AS Min, MAX(Cena_Bez_DPH) AS Max 
        FROM predmety
        WHERE Nazev LIKE ?
        ';

$hodnoty = $_GET["Nazev"] ?? '';
$hodnoty = "%" . $hodnoty . "%";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $hodnoty);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$cena = mysqli_fetch_assoc($res);

$sql = 'SELECT v.Nazev AS Vyrobce , v.ID_V AS ID_V
        FROM predmety p
        LEFT JOIN vyrobce v on p.ID_V = v.ID_V
        WHERE p.Nazev LIKE ?
        GROUP BY Vyrobce';

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $hodnoty);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$vyrobce = mysqli_fetch_all($res, ASSERT_ACTIVE);


$min_search = $_GET["Min"] ?? $cena["Min"];
$max_search = $_GET["Max"] ?? $cena["Max"];
$num_results_on_page = 20;
$page = isset($_GET['Stranka']) && is_numeric($_GET['Stranka']) ? $_GET['Stranka'] : 1;

$vysledek = vyhledani_predmetu($conn, $_GET, $cena, $num_results_on_page);
$predmetysave = $vysledek[0] ?? null;
$total_pages = $vysledek[1]["Celkem_Stranke"] ?? 0;

?>

<div class="container h_container searchh">
    <div class="lajna">
        <div class="side-panel">
            <div class="filtry">
                <form class="vyber-form">

                    <h3 class="sear-kat">Cena</h3>
                    <div class="cont">
                        <div class="slider-styled slider-round" id="slider">

                        </div>
                        <div class="input">
                            <div class="min-input num-inp">
                                <input type="hidden" id="min-db" value="<?php echo $cena["Min"] ?>">
                                <input type="number" id="min" value="<?php echo $min_search ?>">
                                <div>až</div>
                            </div>
                            <div class="max-input num-inp">
                                <input type="hidden" id="max-db" value="<?php echo $cena["Max"] ?>">
                                <input type="number" id="max" value="<?php echo $max_search ?>">
                                <div>Kč</div>
                            </div>
                        </div>
                    </div>
                    <h3 class="sear-kat">Výrobce</h3>
                    <div class="cont" id="vyrobce">
                        <?php

                        foreach ($vyrobce as $item) {
                            echo "
                                        <label class='vyrobce' for='vyrobce-{$item['ID_V']}'>
                                            <input class='vyrobce-nazev' id='vyrobce-{$item['ID_V']}' 
                                                    type='checkbox' value='{$item["ID_V"]}'
                                                    name='vyrobce'>
                                            <span>{$item["Vyrobce"]}</span>
                                        </label>
                                        ";
                        }
                        ?>
                    </div>

                    <h3 class="sear-kat">Hodnocení</h3>
                    <div class="cont">
                        <label for="star-4" class="stars">
                            <div class="star-count">
                                <img src="/svg/star.svg" alt="hvezda">
                                <img src="/svg/star.svg" alt="hvezda">
                                <img src="/svg/star.svg" alt="hvezda">
                                <img src="/svg/star.svg" alt="hvezda">
                                <img src="/svg/star.svg" alt="hvezda" class="empty">
                            </div>
                            <input type="checkbox" id="star-4" name="stars" value="4">
                            <span>4 a více</span>
                        </label>
                        <label for="star-3" class="stars" data-num="3">
                            <div class="star-count">
                                <img src="/svg/star.svg" alt="hvezda">
                                <img src="/svg/star.svg" alt="hvezda">
                                <img src="/svg/star.svg" alt="hvezda">
                                <img src="/svg/star.svg" alt="hvezda" class="empty">
                                <img src="/svg/star.svg" alt="hvezda" class="empty">
                            </div>
                            <input type="checkbox" id="star-3" name="stars" value="3">
                            <span>3 a více</span>
                        </label>
                        <label for="star-2" class="stars" data-num="2">
                            <div class="star-count">
                                <img src="/svg/star.svg" alt="hvezda">
                                <img src="/svg/star.svg" alt="hvezda">
                                <img src="/svg/star.svg" alt="hvezda" class="empty">
                                <img src="/svg/star.svg" alt="hvezda" class="empty">
                                <img src="/svg/star.svg" alt="hvezda" class="empty">
                            </div>
                            <input type="checkbox" id="star-2" name="stars" value="2">
                            <span>2 a více</span>
                        </label>
                        <label for="star-1" class="stars" data-num="1">
                            <div class="star-count">
                                <img src="/svg/star.svg" alt="hvezda">
                                <img src="/svg/star.svg" alt="hvezda" class="empty">
                                <img src="/svg/star.svg" alt="hvezda" class="empty">
                                <img src="/svg/star.svg" alt="hvezda" class="empty">
                                <img src="/svg/star.svg" alt="hvezda" class="empty">
                            </div>
                            <input type="checkbox" id="star-1" name="stars" value="1">
                            <span>1 a více</span>
                        </label>
                    </div>
                </form>
            </div>
        </div>
        <div class="main-obsah" id="main-obsah">
            <?php
            if (empty($predmetysave)) {
                echo "<span class='Info_msg'>Nic takového jsme nenašli</span>";
            }

            foreach ($predmetysave as $item) {
                $hodnocei = $item["Hodnocenii"] * 20;
                echo("
                <div class='predmet'>
                    <a href='/produkt.php?ID_P={$item["ID_P"]}'>
                        <div class='obrazek'>
                            <img src='/images/{$item["H_Obrazek"]}' alt='{$item["Nazev"]}'>
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
                        <span class='cena-produkt'>{$item["Cena"]}</span>
                    </div>
                    <div class='popis'>
                        {$item["Popis"]}
                    </div>
                </div>");
            }

            ?>


        </div>
    </div>

    <?php strankovani($total_pages, $num_results_on_page, $page); ?>

</div>

<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script src="/js/Add_To_cart.js"></script>
<script src="/js/hledat.js"></script>
<script>
    <?php
    $min = $_GET["Min"] ?? null;
    $max = $_GET["Max"] ?? null;
    $vyrobce = $_GET["Vyrobce"] ?? null;
    $hodnoceni = $_GET["Hodnoceni"] ?? null;
    echo("setsearch('$vyrobce','$hodnoceni')")
    ?>

</script>

</html>

