<!doctype html>
<html lang="cs">

<head>
    <meta name="description" content="Dodaci udaje">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="/images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="/images/icon-apple.png">
    <link rel="manifest" href="/manifest.json"/>
    <link rel="stylesheet" href="/style/product.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="/style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/basket_nav.css">
    <link rel="stylesheet" href="/style/checkout.css">
    <link rel="stylesheet" href="/style/dodaci-udaje.css">

    <script src="/service-worker.js"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>

    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<body>
<?php

const MyConst = true;

require "../pomoc/connection.php";
require "../pomoc/navigace.php";
require "../pomoc/funkce.php";
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}


navigace(0);
prihlaseny_uzivatel();
$con = DbCon();

if (isset($_SESSION["error"])) {
    error_msg($_SESSION["error_msg"]);
    unset($_SESSION["error"]);
    unset($_SESSION["error_msg"]);
    echo '<script src="/js/global_funcion.js"></script>
              <script src="/js/login.js"></script>';
    exit();
}

$sql = "SELECT   Jmeno, Prijmeni, Telefon, Mesto, Ulice, PSC
            FROM uzivatel 
            LEFT JOIN adresa a ON a.ID_A = uzivatel.ID_A 
            WHERE ID_U= ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$res = $stmt->get_result();
if (mysqli_num_rows($res) == 1) {
    $res = mysqli_fetch_all($res, ASSERT_ACTIVE)[0];
} else {
    error_msg();
    echo '<script src="/js/global_funcion.js"></script>
              <script src="/js/login.js"></script>';
    exit();
}

if (isset($_SESSION["good"])) {
    error_msg($_SESSION["good_msg"]);
    unset($_SESSION["good"]);
    unset($_SESSION["good_msg"]);
}
?>

<div class="container h_container  mt-5">


    <form autocomplete="off" method="post" id="formular" action="/pomoc/uzivatel-zmena">
        <input type="hidden" name="user_id" <?php echo "value='{$_SESSION["user_id"]}'" ?> >
        <div class="moznosti">
            <h2 class="nadpis">
                Kontakní Ůdaje
            </h2>
            <div class="main-block">


                <div class="form-input full-input">
                    <input type="tel" class="reqierd_input phone" pattern="\d{3}\d{3}\d{3}" name="telefon"
                           id="telefon" required <?php echo "value='{$res["Telefon"]}'" ?>>
                    <label for="telefon">Telefon:</label>

                </div>

                <div class="form-input full-input">
                    <input type="text" class="reqierd_input jmeno" maxlength="25"
                           name="jmeno" id="jmeno" required <?php echo "value='{$res["Jmeno"]}'" ?>>
                    <label for="jmeno">Jméno:</label>

                </div>
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input prijmeni" maxlength="25" name="prijmeni" id="prijmeni"
                           required <?php echo "value='{$res["Prijmeni"]}'" ?>>
                    <label for="prijmeni">Příjmení:</label>

                </div>
            </div>


            <h2 class="nadpis">
                Fakturační údaje
            </h2>
            <div class="main-block">

                <div class="form-input full-input">

                    <input type="text" class="reqierd_input ulice" name="Ulice" id="Ulice"
                           pattern="^[0-9a-zA-Zá-žÁ-Ž\s]+[\s]+[\d]+[\/]*[\d]*$" maxlength="33" required
                        <?php echo "value='{$res["Ulice"]}'" ?>>
                    <label for="Ulice">Ulice a č. p.:</label>
                </div>
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input obec" name="Mesto" id="Mesto" minlength="2" maxlength="40"
                           required <?php echo "value='{$res["Mesto"]}'" ?>>
                    <label for="Mesto">Obec:</label>

                </div>
                <div class="form-input full-input">
                    <input type="text" class="reqierd_input psc" name="PSC" id="PSC"
                           pattern="\d{5}" required <?php echo "value='{$res["PSC"]}'" ?>>
                    <label for="PSC">PSČ:</label>

                </div>

            </div>


        </div>


        <div class="end-div">
            <a href="/" class="btn btn-secondary btn-lg btn-block">Zruřšit změny</a>
            <button type="submit" class="btn btn-primary btn-block validate">Uložit</button>
        </div>
    </form>

</div>

<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>


</body>

</html>
<?php
mysqli_close($con);