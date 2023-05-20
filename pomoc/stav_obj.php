<?php

if ((!defined('MyConst'))) {
    if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
        header('Location: ../error/Method-Not-Allowed.php');
        exit;
    }
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if ($_SESSION["role"] !== "Admin") {
    echo "1";
    exit();
}
$_POST = json_decode(file_get_contents('php://input'), true);

const MyConst = true;

require "connection.php";

if (array_key_exists("moznost", $_POST)) {

    $moznost = $_POST["moznost"];
    $id_ob = $_POST["id_ob"];

    $conn = DbCon();

    $sql = "UPDATE `objednavka` 
                SET Stav = ?
                WHERE ID_OB = ?";

    mysqli_execute_query($conn, $sql, [$moznost, $id_ob]);

    echo 0;

} else {
    echo 1;
}
