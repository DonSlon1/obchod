<!doctype html>
<html lang="cs">

<head>
    <meta name="description" content="Dodaci udaje">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="style/dodaci-udaje.css">

    <title>Document</title>
</head>

<body>
<?php

const MyConst = true;

require "pomoc/connection.php";
require "pomoc/navigace.php";
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}


navigace(0);
$con = DbCon();

// print_r(json_encode($_SESSION, JSON_HEX_QUOT))

?>

<div class="container h_container  mt-5">


    <form class=" preventDefault" autocomplete="off" method="post" id="formular" onsubmit="registration()">
        <div class="moznosti">
            <h2 class="nadpis">
                Kontakní Ůdaje
            </h2>
            <div class="main-block">


                <div class="form-input full-input">
                    <input type="email" class="reqierd_input email" maxlength="50" name="registerEmail"
                           id="registerEmail">
                    <label for="registerEmail">E-mail:</label>

                </div>

                <div class="form-input full-input">
                    <input type="tel" class="reqierd_input phone" pattern="\d{3}\d{3}\d{3}" name="telefon"
                           id="telefon" required>
                    <label for="telefon">Telefon:</label>

                </div>

                <div class="form-input full-input">
                    <input type="text" class="reqierd_input jmeno" maxlength="25" name="jmeno" id="jmeno" required>
                    <label for="jmeno">Jméno:</label>

                </div>
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input prijmeni" maxlength="25" name="prijmeni" id="prijmeni"
                           required>
                    <label for="prijmeni">Příjmení:</label>

                </div>
            </div>

            <h2 class="nadpis">
                Registrační údaje
            </h2>
            <div class="main-block">
                <div class="form-input full-input">

                    <input type="password" name="registerPassword" class="reqierd_input heslo" id="registerPassword"
                           pattern="(?=.*[0-9])(?=.*[!?@#$%^&*])(^.{8,100}$)"
                           required
                    >
                    <label for="registerPassword ">Heslo:</label>
                    <div class='heslo_reqierd'>
                        <span id='delka'>Délka musí být mezi 8-100 znaky</span>
                        <span id='cislo'>Minimílně jedna číslice</span>
                        <span id='znak'>Minimílně jeden speciální znak(@,!,?,#,)</span>
                    </div>
                </div>

            </div>
            <h2 class="nadpis">
                Fakturační údaje
            </h2>
            <div class="main-block">

                <div class="form-input full-input">

                    <input type="text" class="reqierd_input ulice" name="Ulice" id="Ulice"
                           pattern="^[0-9a-zA-Zá-žÁ-Ž\s]+[\s]+[\d]+[\/]*[\d]*$" maxlength="33" required>
                    <label for="Ulice">Ulice a č. p.:</label>
                </div>
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input obec" name="Mesto" id="Mesto" minlength="2" maxlength="40"
                           required>
                    <label for="Mesto">Obec:</label>

                </div>
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input psc" name="PSC" id="PSC" pattern="\d{5}" required>
                    <label for="PSC">PSČ:</label>

                </div>

            </div>


        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="reg_keep-logged-in" name="reg_keep-logged-in">
            <label class="form-check-label" for="reg_keep-logged-in">Keep me logged in</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block validate">Sign Up</button>
    </form>

</div>

<script src="service-worker.js"></script>
<script src="/node_modules/axios/dist/axios.min.js"></script>
<script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
<script src="/js/dodaci_udaje.js"></script>

</body>

</html>