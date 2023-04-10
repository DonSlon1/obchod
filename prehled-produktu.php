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

    <!-- připojení DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>


    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css"/>
    <title>Document</title>

</head>
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

<?php
const MyConst = true;

require "pomoc/connection.php";
require "pomoc/navigace.php";

navigace(0);
?>

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
        $sql = "SELECT Cena_Bez_DPH,H_Obrazek,Nazev,ID_P FROM `predmety` ";
        $res = mysqli_query($conn, $sql);
        $res = mysqli_fetch_all($res, ASSERT_ACTIVE);

        foreach ($res as $produkt) {
            echo("<tr>
                <td><a href='/produkt?ID_P={$produkt["ID_P"]}'><img src=\"images/{$produkt["H_Obrazek"]}\" class='tabulka-obrazek'>{$produkt["Nazev"]}</a></td>
                <td>{$produkt["Cena_Bez_DPH"]}</td>
                <td><a href='/uprava?ID_P={$produkt["ID_P"]}'><img src='svg/tuzka.svg' class='svg-img' alt='upravit' ></a> <img src='svg/krizek.svg' class='svg-img' alt='smazat' onclick='smazat(\"{$produkt["ID_P"]}\")'></td>
                </tr>");
        }
        ?>
    </table>
</div>
<script src="js/prehled-produktu.js"></script>
<script>
    inicializace_produkt()
</script>
</body>
</html>
