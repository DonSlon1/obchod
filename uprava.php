<!doctype html>
<html lang="cz">

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link>
    <link rel="stylesheet" href="style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="style/tabulka-obrazek.css" type="text/css" crossorigin="anonymous">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" crossorigin="anonymous"></script>
    <script src="node_modules/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/zadani-souboru.css">

    <title>Document</title>

</head>

<?php

const MyConst = true;

require "pomoc/connection.php";
require "pomoc/navigace.php";

navigace(0);

if (!array_key_exists("ID_P", $_GET)) {
    print_r("omlováme se ale vypadá to že tento podukt neexistuje");
    exit();
}

$produkt = $_GET["ID_P"];


$conn = DbCon();
$sql = "SELECT * FROM predmety WHERE ID_P='$produkt'";

$res = mysqli_fetch_all(mysqli_query($conn, $sql), ASSERT_ACTIVE);

if (count($res) > 0) {
    $res = $res[0];
} else {
    print_r("omlováme se ale vypadá to že tento podukt neexistuje");
    exit();
}
$parametry = json_decode($res["Parametry"], true);
?>
<body>
<div class="content">
    <form action="pomoc/upravit_produkt" id="produkt" method="post" enctype="multipart/form-data">
        <input type="hidden" name="ID_P" value="<?php echo $res["ID_P"] ?>">
        <div class="moznosti">
            <h2 class="nadpis">
                Základní údaje
            </h2>
            <div class="main-block">
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input " name="nazev" id="nazev"
                           required value="<?php echo $res["Nazev"] ?>">
                    <label for="nazev">Nazev:</label>
                </div>

                <div class="form-input full-input ">
                    <div class="texarea_div">
                    <textarea type="text" class="reqierd_input " name="popis" id="popis"
                              required><?php echo $res["Popis"] ?></textarea>
                        <label class="popis" for="popis">Popis:</label></div>

                </div>


                <div class="form-input full-input">
                    <input type="text" class="reqierd_input cena" maxlength="10" pattern="[0-9]{1,10}" name="cena"
                           id="cena" value="<?php echo $res["Cena_Bez_DPH"] ?>"
                           required>
                    <label for="cena">Cena bez DPH:</label>

                </div>


            </div>


            <h2 class="nadpis">
                Parametry
            </h2>
            <div class="main-block" id="full_parametrs">
                <?php
                $i = 0;
                $j = 0;
                foreach ($parametry as $index => $item) {
                    echo "<div class='form-input  parametry'>
                                 <div class='prametr-nazev'><input type='text' name='vlasnoti[]' value='$index' id='$i'><label for='$i'>Název
                                    Kategorie:</label></div>";

                    $j = 0;
                    foreach ($item as $key => $value) {

                        echo "
                        <div class='parametr-div'>
                            <div class='parametr-input'><input type='text' name='{$i}N[]' id='{$i}N{$j}'  value='$key'><label for='{$i}N{$j}'>Název
                                Parametru:</label></div>
                        <div class='parametr-input'><input type='text' name='{$i}J[]' id='{$i}J{$j}' value='$value'><label for='{$i}J{$j}' >Hodnota
                                Parametru:</label></div>

                        </div>";
                        $j = $j + 1;
                        if ($j == count($item)) {
                            echo "
                        <div class='parametr-div'>
                            <div class='parametr-input'><input type='text' name='{$i}N[]' id='{$i}N{$j}' onchange='on_change_delete($i , $j , \"{$i}N{$j}\")' ><label for='{$i}N{$j}'>Název
                                Parametru:</label></div>
                        <div class='parametr-input'><input type='text' name='{$i}J[]' id='{$i}J{$j}' ><label for='{$i}J{$j}' >Hodnota
                                Parametru:</label></div>

                        </div>";
                        }
                    }


                    echo "</div>";
                    $i = $i + 1;
                }


                ?>

            </div>
        </div>


        <div class="bottom">
            <div class="Checkout">
                <a href="obchod" class="sede">Zpět do obchodu</a>
                <button class="btn btn-primary btn-lg validate">
                    Potvrdit
                </button>
            </div>
        </div>

    </form>
</div>

<script type="text/javascript" src="js/zadani_souboru.js"></script>
<script type="text/javascript" src="js/global_funcion.js"></script>
<script type="text/javascript" src="js/login.js"></script>

</body>
</html>