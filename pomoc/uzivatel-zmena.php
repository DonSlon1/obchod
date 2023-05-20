<?php
const MyConst = true;

require "../pomoc/connection.php";
require "../pomoc/navigace.php";
require "../pomoc/funkce.php";
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_POST["user_id"]) && $_SESSION["user_id"] == $_POST["user_id"]) {

//    TODO toto by nemělo fungovat
    $conn = DbCon();
    $sql = "UPDATE uzivatel 
                LEFT JOIN adresa a on uzivatel.ID_A = a.ID_A 
                SET  Jmeno = ?
                    ,Prijmeni = ?
                    ,Telefon = ?
                    ,Ulice = ?
                    ,PSC = ?
                    ,Mesto = ?
                    ";

    if (mysqli_execute_query($conn, $sql, [$_POST["jmeno"], $_POST["prijmeni"], $_POST["telefon"], $_POST["Ulice"], $_POST["PSC"], $_POST["Mesto"]])) {
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
