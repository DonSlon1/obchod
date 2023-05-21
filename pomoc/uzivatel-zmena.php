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
                WHERE ID_U = ?
                    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisisi", $_POST["jmeno"], $_POST["prijmeni"], $_POST["telefon"], $_POST["Ulice"], $_POST["PSC"], $_POST["Mesto"], $_SESSION["user_id"]);

    if ($stmt->execute()) {
        $_SESSION["good"] = 1;
        $_SESSION["good_msg"] = 'Good';

    } else {
        $_SESSION["error"] = 1;
        $_SESSION["error_msg"] = 'Unknown';
    }
    mysqli_close($conn);


} else {
    $_SESSION["error"] = 1;
    $_SESSION["error_msg"] = 'Unknown';
}
header('Location: /uzivatel/sprava-uctu.php');
exit();
