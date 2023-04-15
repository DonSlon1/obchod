<!doctype html>
<html lang="en">

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link>
    <link rel="stylesheet" href="/style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/tabulka-obrazek.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/objednav.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" crossorigin="anonymous"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>

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
<?php

    const MyConst = true;

    require "../pomoc/connection.php";
    require "../pomoc/navigace.php";
    require "../pomoc/funkce.php";

    navigace(0);
    overeni_uzivatele();

?>
<body>
<div class="container" style="max-width: 100%">


    <div id="error">
        Omlouváme se něco se nepovedlo zkuste to později
    </div>

    <table id="tabuka-poduktu" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID_OB</th>
            <th>Stav</th>
            <th>Cena celkem</th>
            <th>Datum_prijeti</th>
            <th>Typ platby</th>
            <th>Typ dopravy</th>
        </tr>
        </thead>

        <?php

            $conn = DbCon();
            $sql = "SELECT objednavka.ID_OB , Stav,platba ,Datum_prijeti ,doprava ,p.Cena_Bez_DPH* op.Poce_kusu AS cena
                    FROM `objednavka` 
                    LEFT JOIN objednavka_predmet op on objednavka.ID_OB = op.ID_OB 
                    LEFT JOIN predmety p on op.ID_P = p.ID_P
                    GROUP BY objednavka.ID_OB, Stav, Datum_prijeti";
            $res = mysqli_query($conn, $sql);
            $res = mysqli_fetch_all($res, ASSERT_ACTIVE);

            foreach ($res as $objednavka) {
                $cena = number_format(intval($objednavka["cena"]), thousands_separator: ' ');
                echo("<tr id='{$objednavka["ID_OB"]}'>
                <td >{$objednavka["ID_OB"]}</td>
                <td>
                    
                    <div class='select' >
                        <input type='hidden' value='{$objednavka["ID_OB"]}' class='id_ob'>
                        <select class='zdodani' id='standard-select'> ");

                if ($objednavka["Stav"] == 'Přijatá') {
                    echo "<option selected value = 'Přijatá'  > Přijatá</option>";
                } else {
                    echo "<option value = 'Přijatá' > Přijatá</option>";
                }

                if ($objednavka["Stav"] == 'Na Cestě') {
                    echo "<option selected value = 'Na Cestě' > Na Cestě</option>";
                } else {
                    echo "<option value = 'Na Cestě' > Na Cestě</option>";
                }

                if ($objednavka["Stav"] == 'Zrušená') {
                    echo "<option selected value = 'Zrušená' > Zrušená</option>";
                } else {
                    echo "<option value = 'Zrušená' > Zrušená</option>";
                }

                if ($objednavka["Stav"] == 'Vyřízená') {
                    echo "<option selected value = 'Vyřízená' > Vyřízená</option>";
                } else {
                    echo "<option value = 'Vyřízená' > Vyřízená</option>";
                }

                echo("    
                    </select> 
                </div>
                </td>
                <td>$cena Kč</td>
                <td >{$objednavka["Datum_prijeti"]}</td>
                <td >{$objednavka["platba"]}</td>

                <td><div class='down'>{$objednavka["doprava"]}<span class='showw'>▲</span></div></td>
                
                </tr>
");
            }
        ?>
    </table>
</div>
<script src="/js/prehled-objednavek.js"></script>
<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script>
    // inicializace_produkt()
</script>
</body>
</html>