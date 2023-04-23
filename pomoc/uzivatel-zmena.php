<?php
    const MyConst = true;

    require "../pomoc/connection.php";
    require "../pomoc/navigace.php";
    require "../pomoc/funkce.php";
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_POST["user_id"]) && $_SESSION["user_id"] == $_POST["user_id"]) {

        $conn = DbCon();
        $sql = "UPDATE uzivatel 
                LEFT JOIN adresa a on uzivatel.ID_A = a.ID_A 
                SET  Jmeno ='{$_POST["jmeno"]}'
                    ,Prijmeni ='{$_POST["prijmeni"]}'
                    ,Telefon ='{$_POST["telefon"]}'
                    ,Ulice ='{$_POST["Ulice"]}'
                    ,PSC ='{$_POST["PSC"]}'
                    ,Mesto ='{$_POST["Mesto"]}'
                    ";

        if (mysqli_query($conn, $sql)) {
            $_SESSION["good"] = 1;
            $_SESSION["good_msg"] = 'Good';

        } else {
            $_SESSION["error"] = 1;
            $_SESSION["error_msg"] = 'Unknown';
        }
        mysqli_close($conn);
        header('Location: /uzivatel/sprava-uctu.php');
        exit();


    } else {
        $_SESSION["error"] = 1;
        $_SESSION["error_msg"] = 'Unknown';
        header('Location: /uzivatel/sprava-uctu.php');
        exit();
    }
