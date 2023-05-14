<!doctype html>
<html lang="cs">
<head>
    <meta name="description" content="Košík">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="/images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="/images/icon-apple.png">
    <link rel="manifest" href="/manifest.json"/>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="/style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/zadani-souboru.css">
    <script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>


    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<?php
const MyConst = true;

require "../pomoc/navigace.php";
require "../pomoc/funkce.php";
require "../pomoc/connection.php";
$con = DbCon();

overeni_uzivatele();
navigace();


?>
<body>
<div class="content">

    <form action="/pomoc/prod_prid" id="produkt" method="post" enctype="multipart/form-data">
        <?php
        if (array_key_exists("success", $_SESSION)) {
            if ($_SESSION["success"]) {
                echo "
                <div class='alert-success kat' id='message'>
                    Výrobce byl úspěšně přidán
                </div>
                ";

            } else {
                echo "
                <div class='error-msg kat' id='message'>
                    Omlováme se něco se pokazilo zkuste to později
                </div>
                ";
            }
            unset($_SESSION["success"]);
        }
        ?>

        <div class="moznosti">
            <h2 class="nadpis">
                Základní údaje
            </h2>
            <div class="main-block">
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input " name="nazev" id="nazev"
                           required>
                    <label for="nazev">Nazev:</label>
                </div>

                <div class="form-input full-input ">
                    <div class="texarea_div">
                    <textarea type="text" class="reqierd_input " name="popis" id="popis"
                              required></textarea>
                        <label class="popis" for="popis">Popis:</label></div>

                </div>


                <div class="form-input full-input">
                    <input type="text" class="reqierd_input cena" maxlength="10" pattern="[0-9]{1,10}" name="cena"
                           id="cena"
                           required>
                    <label for="cena">Cena bez DPH:</label>

                </div>


            </div>

            <h2 class="nadpis">
                Obrázky
            </h2>
            <div class="main-block" id="file_block">

                <div class="form-input full-input file-input">
                    <input type="file" class="file" accept="image/jpeg , image/png " id="h_obr" name="h_obr">
                    <label class="file">Hlavní Obrázek:</label>
                    <label for="h_obr" class="file-label">Přidat Obrázek</label>
                    <div id="h_obr_filesList" class="filesList">
                    </div>
                </div>

                <div class="form-input full-input file-input">
                    <input type="file" class="file" accept="image/jpeg , image/png " id="attachment" name="file[]"
                           multiple>
                    <label class="file">Obrázky do galerie:</label>
                    <label for="attachment" class="file-label">Přidat Obrázky</label>
                    <div id="filesList" class="filesList">
                    </div>
                </div>

            </div>

            <h2 class="nadpis">
                Zakladní informace
            </h2>
            <div class="main-block">
                <div class="container-options">
                    <div class="form-input full-input search-options-div">
                        <input type="text" class="reqierd_input search-options" name="vyrobce_nazev" id="vyrobce_nazev"
                               required>
                        <label for="vyrobce_nazev">Výrobce:</label>
                    </div>
                    <ul class="value-list">

                        <?php

                        $sql = "SELECT * 
                                    FROM vyrobce 
                                    WHERE ID_V !=0";
                        $res = mysqli_fetch_all(mysqli_execute_query($con, $sql), ASSERT_ACTIVE);
                        foreach ($res as $item) {
                            echo "<li class='vyrobce-li' data-id='{$item["ID_V"]}'>
                                        <img src='/images/{$item["Obrazek"]}'> <span>{$item["Nazev"]}</span>
                                    </li>";
                        }
                        ?>
                    </ul>
                    <input type="hidden" name="vyrobce" id="vyrobce">
                    <span class="modal-toggle" data-toggle="modal"
                          data-target="#modal-vyrobce">Přidat vyrobce
                    </span>
                </div>

                <div class="container-options">
                    <div class="form-input full-input search-options-div">
                        <input type="text" class="reqierd_input search-options" name="skupina_nazev" id="skupina_nazev"
                               required>
                        <label for="skupina_nazev">Kategorie:</label>
                    </div>
                    <ul class="value-list" id="valu-kategorie">
                        <?php
                        $sql = "SELECT * 
                                    FROM kategorie 
                                    WHERE ID_K != 0";
                        $res = mysqli_fetch_all(mysqli_execute_query($con, $sql), ASSERT_ACTIVE);
                        foreach ($res as $item) {
                            $nazev = htmlspecialchars($item["Nazev"]);
                            echo "<li class='vyrobce-li' data-id='{$item["ID_K"]}' role='option'>
                                        <svg><use href='/svg/main.svg#ico-directory'></use></svg><span>$nazev</span>
                                    </li>";
                        }
                        ?>
                    </ul>
                    <input type="hidden" name="kategorie" id="kategorie">
                    <span class="modal-toggle" data-toggle="modal"
                          data-target="#modal-kategorie">Přidat kategorii
                    </span>


                </div>


            </div>


            <h2 class="nadpis">
                Parametry
            </h2>
            <div class="main-block" id="full_parametrs">

            </div>
        </div>


        <div class="bottom">
            <div class="Checkout">
                <a href="/" class="sede">Zrušit přidáváí</a>
                <button class="btn btn-primary btn-lg validate">Přidat předmět
                </button>
            </div>
        </div>

    </form>

    <!--    Modal pro novou Kategorii-->

    <div class="modal fade" id="modal-kategorie" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered recenze" role="document">
            <div class="modal-content recenze_body" style="width: 90%">
                <div>

                    <button type="button" class="close mr-2 mt-2" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-4 pr-4 pb-4">
                    <form class="preventDefault big" id="kategorie_form">
                        <div class="form-input full-input search-options-div">
                            <input type="text" class="reqierd_input search-options" name="new_kategorie"
                                   id="new_kategorie"
                                   required>
                            <label for="new_kategorie">Název Kategorie:</label>
                        </div>
                        <button class="btn btn-primary btn-lg validate">Přidat Kategorii
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Přidání výrobce    -->
    <div class="modal fade" id="modal-vyrobce" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered recenze" role="document">
            <div class="modal-content recenze_body" style="width: 90%">
                <div>

                    <button type="button" class="close mr-2 mt-2" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-4 pr-4 pb-4">
                    <form class="big" id="vyrobce_form" method="post" action="/pomoc/novy_vyrobce"
                          enctype="multipart/form-data">
                        <div class="form-input full-input  search-options-div">
                            <input type="text" class="reqierd_input search-options" name="new_vyrobce"
                                   id="new_vyrobce"
                                   required>
                            <label for="new_vyrobce">Název Výrobce:</label>
                            <div id="file_block_vyrobce">
                                <div class="form-input full-input file-input">
                                    <input type="file" class="file" accept="image/jpeg , image/png " id="vyr_obr"
                                           name="vyr_obr">
                                    <label class="file">Obrázek Výrobce:</label>
                                    <label for="vyr_obr" class="file-label">Přidat Obrázek</label>
                                    <div id="vyr_obr_filesList" class="filesList">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary btn-lg validate">Přidat Výrobce
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript" src="/js/zadani_souboru.js"></script>
<script type="text/javascript" src="/js/global_funcion.js"></script>
<script type="text/javascript" src="/js/login.js"></script>
<script type="text/javascript" src="/js/select.js"></script>


</body>
</html>
