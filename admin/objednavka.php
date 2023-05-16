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
    <link rel="stylesheet" href="/style/objednav.css">

    <script src="/service-worker.js"></script>
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
            $res = mysqli_execute_query($conn, $sql);
            $res = mysqli_fetch_all($res, ASSERT_ACTIVE);

            foreach ($res as $objednavka) {
                $cena = number_format(intval($objednavka["cena"]), thousands_separator: ' ');
                echo("<tr id='{$objednavka["ID_OB"]}'>
                <td >{$objednavka["ID_OB"]}</td>
                <td>
                    
                    <div class='select' >
                        <input type='hidden' value='{$objednavka["ID_OB"]}' class='id_ob'>
                        <select class='zdodani' > ");

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