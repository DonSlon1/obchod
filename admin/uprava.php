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
    <link rel="stylesheet" href="/style/tabulka-obrazek.css" type="text/css" crossorigin="anonymous">


    <script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>


    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/style/zadani-souboru.css">

    <title>Document</title>

</head>

<?php

const MyConst = true;

require "../pomoc/connection.php";
require "../pomoc/navigace.php";
require "../pomoc/funkce.php";

overeni_uzivatele();

navigace(0);

if (!array_key_exists("ID_P", $_GET)) {
    error_msg('Neexistuje');
    echo '<script type="text/javascript" src="/js/global_funcion.js"></script>
<script type="text/javascript" src="/js/login.js"></script>';
    exit();
}

$produkt = $_GET["ID_P"];


$conn = DbCon();
$sql = "SELECT * 
            FROM predmety 
            WHERE ID_P=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $produkt);
$stmt->execute();
$res = $stmt->get_result();
$res = mysqli_fetch_all($res, ASSERT_ACTIVE);

if (count($res) > 0) {
    $res = $res[0];
} else {
    error_msg('Neexistuje');
    echo '<script type="text/javascript" src="/js/global_funcion.js"></script>
              <script type="text/javascript" src="/js/login.js"></script>';
    exit();
}
$parametry = json_decode($res["Parametry"], true);
?>
<body>
<div class="content">
    <form action="../pomoc/upravit_produkt" id="produkt" method="post" enctype="multipart/form-data">
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
                Zakladní informace
            </h2>
            <div class="main-block">
                <div class="container-options">
                    <div class="form-input full-input search-options-div">
                        <?php
                        $id_v = $res["ID_V"];
                        $sql2 = "SELECT Nazev 
                                    FROM vyrobce
                                    WHERE ID_V = ?";
                        $stmt = $conn->prepare($sql2);
                        $stmt->bind_param("i", $id_v);
                        $stmt->execute();
                        $res_tmp = $stmt->get_result();
                        $ress = mysqli_fetch_assoc($res_tmp)["Nazev"]
                        ?>
                        <input type="text" class="reqierd_input search-options" name="vyrobce_nazev" id="vyrobce_nazev"
                               required value="<?php echo $ress ?>">
                        <label for="vyrobce_nazev">Výrobce:</label>
                    </div>
                    <ul class="value-list">

                        <?php

                        $sql2 = "SELECT * 
                                    FROM vyrobce 
                                    WHERE ID_V !=0";
                        $ress = mysqli_fetch_all(mysqli_query($conn, $sql2), ASSERT_ACTIVE);
                        foreach ($ress as $item) {
                            $nazev = htmlspecialchars($item["Nazev"]);
                            echo "<li class='vyrobce-li' data-id='{$item["ID_V"]}'>
                                        <img src='/images/{$item["Obrazek"]}'> <span>$nazev</span>
                                    </li>";
                        }
                        ?>
                    </ul>
                    <input type="hidden" name="vyrobce" id="vyrobce" value="<?php echo $id_v ?>">
                    <span class="modal-toggle" data-toggle="modal"
                          data-target="#modal-vyrobce">Přidat vyrobce
                    </span>
                </div>

                <div class="container-options">

                    <div class="form-input full-input search-options-div">
                        <?php
                        $id_k = $res["ID_K"];
                        $sql2 = "SELECT Nazev 
                                    FROM kategorie
                                    WHERE ID_K = ?";

                        $stmt = $conn->prepare($sql2);
                        $stmt->bind_param("i", $id_k);
                        $stmt->execute();
                        $res_tmp = $stmt->get_result();
                        $ress = mysqli_fetch_assoc($res_tmp)["Nazev"]
                        ?>
                        <input type="text" class="reqierd_input search-options" name="skupina_nazev" id="skupina_nazev"
                               required value="<?php echo $ress ?>">
                        <label for="skupina_nazev">Kategorie:</label>
                    </div>
                    <ul class="value-list" id="valu-kategorie">
                        <?php
                        $sql2 = "SELECT * 
                                    FROM kategorie 
                                    WHERE ID_K != 0";
                        $ress = mysqli_fetch_all(mysqli_query($conn, $sql2), ASSERT_ACTIVE);
                        foreach ($ress as $item) {
                            $nazev = htmlspecialchars($item["Nazev"]);
                            echo "<li class='vyrobce-li' data-id='{$item["ID_K"]}' role='option'>
                                        <svg><use href='/svg/main.svg#ico-directory'></use></svg><span>$nazev</span>
                                    </li>";
                        }
                        ?>
                    </ul>
                    <input type="hidden" name="kategorie" id="kategorie" value="<?php echo $id_k ?>">
                    <span class="modal-toggle" data-toggle="modal"
                          data-target="#modal-kategorie">Přidat kategorii
                    </span>


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
                <a href="/" class="sede">Zpět do obchodu</a>
                <button class="btn btn-primary btn-lg validate">
                    Potvrdit
                </button>
            </div>
        </div>

    </form>
</div>


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


<script type="text/javascript" src="/js/zadani_souboru.js"></script>
<script type="text/javascript" src="/js/global_funcion.js"></script>
<script type="text/javascript" src="/js/login.js"></script>
<script type="text/javascript" src="/js/select.js"></script>


</body>
</html>