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

    <link>
    <link rel="stylesheet" href="/style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/product.css" type="text/css" crossorigin="anonymous">


    <script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>


    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>


    <title>Document</title>

</head>
<?php

const MyConst = true;

require "../pomoc/connection.php";
require "../pomoc/navigace.php";
require "../pomoc/funkce.php";

navigace(0);
prihlaseny_uzivatel();

$conn = DbCon();


if (!array_key_exists("ID_R", $_GET)) {
    error_msg("Neexistuje");
    echo '<script src="/js/login.js"></script>
<script src="/js/global_funcion.js"></script>';
    exit();
}

$sql = "SELECT ID_R,recenze.Popis,Kladne,Zaporne,recenze.Hodnoceni,p.Nazev,p.H_Obrazek 
            FROM recenze 
            LEFT JOIN predmety p on recenze.ID_P = p.ID_P
            WHERE ID_R= ? AND ID_U = ? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $_GET["ID_R"], $_SESSION["user_id"]);
$stmt->execute();
$res = $stmt->get_result();

if (0 >= mysqli_num_rows($res)) {
    error_msg("Neexistuje");
    echo '<script src="/js/login.js"></script>
<script src="/js/global_funcion.js"></script>';
    exit();
}


$res = mysqli_fetch_all($res, ASSERT_ACTIVE);

if (count($res) > 0) {
    $res = $res[0];
} else {
    error_msg("Neexistuje");
    echo '<script src="/js/login.js"></script>
<script src="/js/global_funcion.js"></script>';
    exit();
}

$kladne = json_decode($res["Kladne"]);
$zaporne = json_decode($res["Zaporne"]);
$hodnoceni = htmlspecialchars($res["Hodnoceni"]);
$popis = htmlspecialchars($res["Popis"]);
$H_image = htmlspecialchars($res["H_Obrazek"]);
$nazev = htmlspecialchars($res["Nazev"])
?>
<body>
<div style="display: flex; flex-wrap: wrap">
    <div style="max-width: fit-content;margin: auto;">
        <?php
        echo "<div class='m-auto' style='max-width: fit-content'>
                                          <img src='/images/$H_image' alt='" . htmlspecialchars($H_image) . "' class='mh-100 d-inline img-fluid ' style='height: 10em;'>
                                      </div>
                                      <div class='w-100 text-center pt-2 pb-2 text-muted'>
                                      
                                       {$nazev}
                                       </div>"
        ?>

        <div id="error-recen" class="error-msg"></div>
        <h2 class="text-info">Jak jste se zbožím spokojen?</h2>
        <div id="rating" class="pt-2 m-auto">
            <img src="/svg/star.svg" alt="Star" class="starrs50" data-value="1">
            <img src="/svg/star.svg" alt="Star" class="starrs50" data-value="2">
            <img src="/svg/star.svg" alt="Star" class="starrs50" data-value="3">
            <img src="/svg/star.svg" alt="Star" class="starrs50" data-value="4">
            <img src="/svg/star.svg" alt="Star" class="starrs50" data-value="5">
        </div>
    </div>
</div>
<!-- TODO přidat ověření uživatele -->
<form id="recene" method="post" action="/pomoc/r_update">
    <div class="container mt-4 ">
        <?php
        echo '<input type="hidden" name="ID_R" id="ID_R" value="' . $_GET["ID_R"] . '">'
        ?>

        <input type="hidden" id="rating-value" value="<?php echo $hodnoceni ?>" name="rating">
        <div class="row">
            <div class="col mb-4 mr-4">
                <div class="row">
                    <label class="text-success">Popište klady</label>
                    <div class="container p-3 bb" id="klady">
                        <?php
                        foreach ($kladne as $item) {
                            $item = htmlspecialchars($item);
                            echo "<div class='row '>
                            <div class='col pr-0 fitcont float-right'>
                                <svg class='rev-icon pos-icon ' focusable='false' viewBox='0 0 24 24'
                                     aria-hidden='true'>
                                    <path
                                        d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 11h-3v3c0 .55-.45 1-1 1s-1-.45-1-1v-3H8c-.55 0-1-.45-1-1s.45-1 1-1h3V8c0-.55.45-1 1-1s1 .45 1 1v3h3c.55 0 1 .45 1 1s-.45 1-1 1z'></path>
                                </svg>
                            </div>
                            <div class='col m-auto'>
                                                    <textarea class='form-control border-0 p-0 ' 
                                                              name='positive[]' rows='1'>$item</textarea>
                            </div>
                        </div>";
                        }
                        ?>
                        <div class="row ">
                            <div class="col pr-0 fitcont float-right">
                                <svg class="rev-icon pos-icon " focusable="false" viewBox="0 0 24 24"
                                     aria-hidden="true">
                                    <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 11h-3v3c0 .55-.45 1-1 1s-1-.45-1-1v-3H8c-.55 0-1-.45-1-1s.45-1 1-1h3V8c0-.55.45-1 1-1s1 .45 1 1v3h3c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
                                </svg>
                            </div>
                            <div class="col m-auto">
                                                    <textarea class="form-control border-0 p-0 "
                                                              oninput="auto_grow(this) " id='positive'
                                                              name="positive[]" rows="1"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="row">
                    <label class="text-danger">Popište zápory</label>
                    <div class="container p-3 bb" id="zapory">
                        <?php
                        foreach ($zaporne as $item) {
                            $item = htmlspecialchars($item);
                            echo "<div class='row '>
                            <div class='col pr-0 fitcont float-right'>
                                <svg class='rev-icon neg-icon ' focusable='false' viewBox='0 0 24 24'
                                     aria-hidden='true'>
                                    <path
                                        d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 11H8c-.55 0-1-.45-1-1s.45-1 1-1h8c.55 0 1 .45 1 1s-.45 1-1 1z'></path>
                                </svg>
                            </div>
                            <div class='col'>
                                                    <textarea class='form-control border-0 p-0'
                                                              name='negative[]' rows='1'>$item</textarea>
                            </div>
                        </div>";
                        }
                        ?>
                        <div class="row ">
                            <div class="col pr-0 fitcont float-right">
                                <svg class="rev-icon neg-icon " focusable="false" viewBox="0 0 24 24"
                                     aria-hidden="true">
                                    <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 11H8c-.55 0-1-.45-1-1s.45-1 1-1h8c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
                                </svg>
                            </div>
                            <div class="col">
                                                    <textarea class="form-control border-0 p-0"
                                                              oninput="auto_grow(this)" id="negative"
                                                              name="negative[]" rows="1"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container m-2">
                <div class="row">
                    <label for="zkusenost">Popište svou zkušenost s produktem (nepovinné)</label>
                    <textarea class="form-control  text" oninput="auto_grow(this)"
                              id="zkusenost"
                              name="zkusenost" rows="1"><?php echo $popis ?></textarea>
                </div>
            </div>
            <div class="container pl-0">
                <div class="container m-2 w-max-100 w-fitcontent border  " id="ddforimg"
                     style="display: none">
                    <div class="row p-1 " id="plforimg">

                    </div>
                </div>

            </div>

        </div>
        <div class="row">

        </div>
        <div class="bottm">
            <a href="/uzivatel/recenze_uz.php" class="btn btn-secondary btn-lg btn-block">Zruřšit změny</a>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Potvrdit změny</button>
        </div>
    </div>
</form>
<script src="/js/login.js"></script>
<script src="/js/global_funcion.js"></script>
<script src="/js/produkt.js"></script>
</body>
</html>