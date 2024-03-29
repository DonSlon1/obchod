<?php

const MyConst = true;


require "../pomoc/funkce.php";
prihlaseny_uzivatel();
?>
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

require "../pomoc/connection.php";
require "../pomoc/navigace.php";
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
                    WHERE ID_U = ?
                    GROUP BY objednavka.ID_OB, Stav, Datum_prijeti";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION["user_id"]);
        $stmt->execute();
        $res = $stmt->get_result();
        $res = mysqli_fetch_all($res, ASSERT_ACTIVE);

        foreach ($res as $objednavka) {
            $cena = number_format(intval($objednavka["cena"]), thousands_separator: ' ');
            echo("
                <tr id='{$objednavka["ID_OB"]}'>
                    <td>
                        {$objednavka["Stav"]}
                    </td>
                    <td>$cena Kč</td>
                    <td >{$objednavka["Datum_prijeti"]}</td>
                    <td >{$objednavka["platba"]}</td>
    
                    <td>
                        <div class='down'>
                            {$objednavka["doprava"]}
                            <span class='showw'>▲</span>
                        </div>
                    </td>
                
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