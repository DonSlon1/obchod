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

    <link rel="stylesheet" type="text/css" href="/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <script src="/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <title>Document</title>

</head>
<?php
    const MyConst = true;

    require "../pomoc/connection.php";
    require "../pomoc/navigace.php";
    require "../pomoc/funkce.php";

    overeni_uzivatele();
    navigace(0);
?>
<body>
<div class="modal  fade " id="smazat-produkt" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <span class="m-auto">Opravdu chcete smazet produkt a všecny informace k němu?</span>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <button type="button" class="btn btn-primary w-100" id="Ponechat">Ponechat</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-secondary w-100" id="Odstranit">Smazat</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="container" style="max-width: 100%">


    <div id="error">
        Omlouváme se něco se nepovedlo zkuste to později
    </div>

    <table id="tabuka-poduktu" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Nazev</th>
            <th>Cena Bez DPH</th>
            <th>Akce</th>
        </tr>
        </thead>

        <?php


            $conn = DbCon();
            $sql = "SELECT Cena_Bez_DPH,H_Obrazek,Nazev,ID_P 
                    FROM `predmety` ";

            $res = mysqli_execute_query($conn, $sql);
            $res = mysqli_fetch_all($res, ASSERT_ACTIVE);

            foreach ($res as $produkt) {
                $ID_P = $produkt["ID_P"];
                $Nazev = htmlspecialchars($produkt["Nazev"]);
                $H_Obrazek = htmlspecialchars($produkt["H_Obrazek"]);
                $Cena_Bez_DPH = number_format(htmlspecialchars($produkt["Cena_Bez_DPH"]), thousands_separator: ' ').' Kč';

                echo("<tr>
                <td><a href='/produkt?ID_P=$ID_P'><img src=\"/images/$H_Obrazek\" class='tabulka-obrazek'>$Nazev</a></td>
                <td>$Cena_Bez_DPH</td>
                <td><a href='uprava?ID_P=$ID_P'><img src='/svg/tuzka.svg' class='svg-img' alt='upravit' ></a> <img src='/svg/krizek.svg' class='svg-img' alt='smazat' onclick='smazat(\"$ID_P\")'></td>
                </tr>");
            }
        ?>
    </table>
</div>
<script src="/js/prehled-produktu.js"></script>
<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script>
    inicializace_produkt()
</script>
</body>
</html>
