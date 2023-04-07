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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="style/zadani-souboru.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" crossorigin="anonymous"></script>
    <script src="node_modules/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<?php
    const MyConst = true;

    require "pomoc/navigace.php";

    navigace();

?>
<div class="content">
    <form action="pomoc/prod_prid" id="produkt" method="post" enctype="multipart/form-data">
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
                Parametry
            </h2>
            <div class="main-block">

                <div class="form-input  parametry">
                    <div class="prametr-nazev">
                        <input type="text" name="cena" id="1">
                        <label for="1">Název Kategorie:</label>
                    </div>

                    <div class="parametr-div">
                        <div class="parametr-input">
                            <input type="text" name="1N[]" id="1N1">
                            <label for="1N1">Název Parametru:</label>
                        </div>

                        <div class="parametr-input">
                            <input type="text" name="1J[]" id="1J1">
                            <label for="1J1">Hodnota Parametru:</label>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <div class="bottom">
            <div class="Checkout">
                <a href="obchod" class="sede">Zpět do obchodu</a>
                <button class="btn btn-primary btn-lg validate">Pokračovat v
                    objednávce
                </button>
            </div>
        </div>

    </form>
</div>

<script type="text/javascript" src="js/zadani_souboru.js"></script>
<script type="text/javascript" src="js/global_funcion.js"></script>
<script type="text/javascript" src="js/login.js"></script>

<body>
