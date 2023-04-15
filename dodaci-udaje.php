<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (!isset($_SESSION["platba"]) || !isset($_SESSION["doprava"])) {
        header('Location: ./basket.php');
    }
    const MyConst = true;
    require "pomoc/funkce.php";
    require "pomoc/connection.php";
    overeni_kosik();
?>
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


    require "pomoc/navigace.php";
    require "pomoc/doprava.php";
    require "pomoc/platba.php";


    $response_doprava = ziskat_dopravu();
    $response_platba = ziskat_platbu();

    navigace(0);
    $con = DbCon();

?>

<div class="container h_container  mt-5">
    <ul class="navigace">
        <li>
            <a href="basket.php" class="nepodtrh">
                <span>Košík</span>
            </a>
        </li>
        <li>
            <a href="checkout.php" class="nepodtrh">
                <span>Doprava a pladba</span>
            </a>
        </li>
        <li class="active_li">
            <a class="nepodtrh">
                <span>Souhrn objednávky</span>
            </a>
        </li>
    </ul>

    <form class="cont   <?php if (array_key_exists('logged_in', $_SESSION)) {
        echo ' user_logged';
    } ?>" id="formular" method="post" action="pomoc/zad_obj">
        <div class="moznosti">
            <h2 class="nadpis">
                Kontakní Ůdaje
            </h2>
            <div class="main-block">
                <?php
                    $response = array();
                    if (!array_key_exists("logged_in", $_SESSION)) {

                        echo('
    
                            <div id="chete-se-prihlasit">
                                <a class="btn btn-primary" data-toggle="modal" data-target="#LoginModal">
                                    Přihlásit se
                                </a>
                                <p>
                                    Máte u nás účet? Přihlaste se a my vše vyplníme za vás.
                                </p>
                            </div>
                            ');

                    } else {
                        $ID_U = $_SESSION["user_id"];
                        $sql = "select Email ,Jmeno,Prijmeni ,Telefon , Mesto,Ulice,PSC FROM uzivatel LEFT JOIN adresa a on a.ID_A = uzivatel.ID_A WHERE ID_U = '$ID_U'";
                        $response = mysqli_fetch_all(mysqli_query($con, $sql), ASSERT_ACTIVE)[0];

                    }
                ?>
                <div class="form-input full-input">
                    <input type="email" class="reqierd_input email" maxlength="50" name="email_dou" id="email_dou"
                        <?php if (array_key_exists("Email", $response)) {
                            echo 'value="'.$response["Email"].'"';
                        } ?> required>
                    <label for="email_dou full-input">E-mail:</label>

                </div>
                <div class="form-input full-input">
                    <input type="tel" class="reqierd_input phone" pattern="\d{3}\d{3}\d{3}" name="tel_dou" id="tel_dou"
                        <?php if (array_key_exists("Telefon", $response)) {
                            echo 'value="'.$response["Telefon"].'"';
                        } ?> required>
                    <label for="tel_dou">Telefon:</label>

                </div>
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input jmeno" maxlength="25" name="jmeno_dou" id="jmeno_dou"
                        <?php if (array_key_exists("Jmeno", $response)) {
                            echo 'value="'.$response["Jmeno"].'"';
                        } ?> required>
                    <label for="jmeno_dou">Jméno:</label>

                </div>
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input prijmeni" maxlength="25" name="prijmeni_dou"
                           id="prijmeni_dou"
                        <?php if (array_key_exists("Prijmeni", $response)) {
                            echo 'value="'.$response["Prijmeni"].'"';
                        } ?> required>
                    <label for="prijmeni_dou">Příjmení:</label>

                </div>
            </div>


            <h2 class="nadpis">
                Fakturační údaje
            </h2>
            <div class="main-block">

                <div class="form-input full-input">
                    <input type="text" class="reqierd_input ulice" name="ulice_dou" id="ulice_dou"
                           pattern="^[0-9a-zA-Zá-žÁ-Ž\s]+[\s]+[\d]+[\/]*[\d]*$" maxlength="33"
                        <?php if (array_key_exists("Ulice", $response)) {
                            echo 'value="'.$response["Ulice"].'"';
                        } ?> required>
                    <label for="ulice_dou">Ulice a č. p.:</label>

                </div>
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input obec" name="obec_dou" id="obec_dou" minlength="2"
                           maxlength="40"
                        <?php if (array_key_exists("Mesto", $response)) {
                            echo 'value="'.$response["Mesto"].'"';
                        } ?> required>
                    <label for="obec_dou">Obec:</label>

                </div>
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input psc" name="psc_dou" id="psc_dou" pattern="\d{5}"
                           minlength="5" <?php if (array_key_exists("PSC", $response)) {
                        echo 'value="'.$response["PSC"].'"';
                    } ?> required>
                    <label for="psc_dou">PSČ:</label>

                </div>

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
                <button class="btn btn-primary btn-lg validate">Pokračovat v
                    objednávce
                </button>
            </div>
        </div>
    </form>
</div>

<script src="service-worker.js"></script>
<script src="/node_modules/axios/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script src="/js/dodaci_udaje.js"></script>

</body>

</html>