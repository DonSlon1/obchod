<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css">
    <title>Document</title>

</head>
<body>


<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    require "pomoc/navigace.php";
    require "pomoc/connection.php";

    navigace();

    $conn = DbCon();
    $sql1 = "SELECT * FROM predmety ";

    $res = mysqli_query($conn, $sql1);
    $myArray = [];
    $count = 0;
    while ($row = $res->fetch_assoc()) {

        $sql2 = "SELECT * FROM recenze WHERE ID_P = '".$row['ID_P']."'";
        $hod_query = mysqli_query($conn, $sql2);
        $hod = 0;
        $pocet = 0;
        $Nex_Row = false;
        while ($rov1 = $hod_query->fetch_assoc()) {
            $hod = $hod + $rov1['Hodnoceni'];
            $pocet = $pocet + 1;
        }
        if ($pocet == 0) {
            $vls = 0.0;
        } else {
            $vls = round($hod / $pocet, 1);
        }

        $count += 1;
        if ($count == 1) {
            echo '<div class="row g-3">';
        }

        echo('

        <div class="produkt input-group-sm mb-3 col-md-4 ">
            <div class="top">

                <img class="image-produktu" title="'.$row["Nazev"].'" alt="'.$row["Nazev"].'" src="./images/'.$row['H_Obrazek'].'"/>
                <div>
                <div class="star-row">
                    <div class="hvezdy" title="Hodnocení '.$vls.'/5">
                        <div class="hvezdy-prazdne"></div>
                        <div class="pocet-hvezd" style="width:'.($vls * 20).'%"></div>
                    </div>
                </div>
                </div>
                <h2 class="nazev-produktu">'.$row["Nazev"].'</h2>
                '.$row["Popis"].'
            </div>
            <div class="sopdek">
                <div class="cena">'.$row["Cena_Bez_DPH"].'</div>
                <div class="stranka"><a href="./produkt.php?ID_P='.$row["ID_P"].'"><button>aaa</button></a></div>
            </div>
        </div>
    '
        );
        if ($count == 3) {
            echo '</div>';
            $count = 0;
        }

    }


?>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script src="js/global_funcion.js"></script>
<script src="js/login.js"></script>


</body>
<style>

    .nav-item > span {
        cursor: pointer;
    }
</style>
</html>



