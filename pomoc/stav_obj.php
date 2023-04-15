<?php

    if ((!defined('MyConst'))) {
        if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
            header('HTTP/1.0 405 ');
            exit;
        }
    }

    $_POST = json_decode(file_get_contents('php://input'), true);

    const MyConst = true;

    require "connection.php";

    if (array_key_exists("moznost", $_POST)) {

        $moznost = $_POST["moznost"];
        $id_ob = $_POST["id_ob"];

        $conn = DbCon();

        $sql = "UPDATE `objednavka` 
                SET Stav = '$moznost'
                WHERE ID_OB = $id_ob";

        mysqli_query($conn, $sql);

        echo 0;

    } else {
        echo 1;
    }
