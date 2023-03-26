<!doctype html>
<html lang="en">

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="style/basket_nav.css">
    <link rel="stylesheet" href="style/checkout.css">
    <link rel="stylesheet" href="style/dodaci-udaje.css">
    <title>Document</title>
</head>

<body>
<?php


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


                <div class="form-input">
                    <label for="registerEmail">E-mail:</label>
                    <input type="email" class="reqierd_input email" maxlength="50" name="registerEmail"
                           id="registerEmail" required>
                </div>

                <div class="form-input">
                    <label for="telefon">Telefon:</label>
                    <input type="tel" class="reqierd_input phone" pattern="\d{3}\d{3}\d{3}" name="telefon"
                           id="telefon" required>
                </div>

                <div class="form-input">
                    <label for="jmeno">Jméno:</label>
                    <input type="text" class="reqierd_input jmeno" maxlength="25" name="jmeno" id="jmeno" required>
                </div>
                <div class="form-input">
                    <label for="prijmeni">Příjmení:</label>
                    <input type="text" class="reqierd_input prijmeni" maxlength="25" name="prijmeni" id="prijmeni"
                           required>
                </div>
            </div>

            <h2 class="nadpis">
                Registrační údaje
            </h2>
            <div class="main-block">
                <div class="form-input">

                    <label for="registerPassword">Heslo:</label>
                    <input type="password" name="registerPassword" class="reqierd_input heslo" id="registerPassword"
                           pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(.{8,100})$"
                           required
                    >
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

                <div class="form-input">
                    <label for="Ulice">Ulice a č. p.:</label>
                    <input type="text" class="reqierd_input ulice" name="Ulice" id="Ulice"
                           pattern="^[A-Z][a-z]+ \d+\/\d+[A-Za-z]*|[A-Z][a-z]+ \d+$" maxlength="33" required>
                </div>
                <div class="form-input">
                    <label for="Mesto">Obec:</label>
                    <input type="text" class="reqierd_input obec" name="Mesto" id="Mesto" minlength="2" maxlength="40"
                           required>
                </div>
                <div class="form-input">
                    <label for="PSC">PSČ:</label>
                    <input type="text" class="reqierd_input psc" name="PSC" id="PSC" pattern="\d{5}" required>
                </div>

            </div>


        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="reg_keep-logged-in" name="reg_keep-logged-in">
            <label class="form-check-label" for="reg_keep-logged-in">Keep me logged in</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
    </form>

</div>

<script src="service-worker.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="js/global_funcion.js"></script>
<script src="js/login.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script src="js/dodaci_udaje.js"></script>

</body>

</html>