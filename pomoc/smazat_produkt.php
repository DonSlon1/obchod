<?php
    if ((!defined('MyConst'))) {
        if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
            header('Location: ../error/Method-Not-Allowed.php');
            exit;
        }
    }
    const MyConst = true;

    require "connection.php";
    $smazani = json_decode(file_get_contents('php://input'), true);

    $conn = DbCon();
    if (array_key_exists("ID_P", $smazani)) {

        $sql = "SELECT Obrazek FROM obrazky WHERE ID_P = '{$smazani["ID_P"]}'";

        $res = mysqli_fetch_all(mysqli_query($conn, $sql), ASSERT_ACTIVE);

        foreach ($res as $re) {
            if (file_exists("../images/{$re["Obrazek"]}") && $re["Obrazek"] != "") {
                unlink("../images/{$re["Obrazek"]}");
            }
        }


        $sql = "DELETE FROM obrazky WHERE ID_P = '{$smazani["ID_P"]}'";

        if (!mysqli_query($conn, $sql)) {
            echo "1";
            exit();
        }

        $sql = "SELECT Obrazek FROM recenze WHERE ID_P = '{$smazani["ID_P"]}'";

        $res = mysqli_fetch_all(mysqli_query($conn, $sql), ASSERT_ACTIVE);

        foreach ($res as $re) {
            if (file_exists("../images/{$re["Obrazek"]}") && $re["Obrazek"] != "") {
                unlink("../images/{$re["Obrazek"]}");
            }
        }


        $sql = "DELETE FROM recenze WHERE ID_P = '{$smazani["ID_P"]}'";

        if (!mysqli_query($conn, $sql)) {
            echo "1";
            exit();
        }

        $sql = "DELETE FROM objednavka_predmet WHERE ID_P = '{$smazani["ID_P"]}'";

        if (!mysqli_query($conn, $sql)) {
            echo "1";
            exit();
        }

        $sql = "SELECT H_Obrazek FROM predmety WHERE ID_P = '{$smazani["ID_P"]}'";

        $res = mysqli_fetch_all(mysqli_query($conn, $sql), ASSERT_ACTIVE);

        foreach ($res as $re) {
            if (file_exists("../images/{$re["H_Obrazek"]}") && $re["H_Obrazek"] != "")
                unlink("../images/{$re["H_Obrazek"]}");
        }

        $sql = "DELETE FROM predmety WHERE ID_P = '{$smazani["ID_P"]}'";

        if (!mysqli_query($conn, $sql)) {
            echo "1";
            exit();
        }

        echo "0";
    }
