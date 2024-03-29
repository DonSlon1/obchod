<?php
if ((!defined('MyConst'))) {
    if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
        header('Location: ../error/Method-Not-Allowed.php');
        exit;
    }
}
const MyConst = true;

require "connection.php";
$kategorie = json_decode(file_get_contents('php://input'), true) ?? $_POST;

$con = DbCon();
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SESSION["role"] != "Admin") {
    echo "0";
    exit();
}

if ($kategorie["funkce"] == "kategorie") {
    $sql = "SELECT Nazev 
            FROM kategorie 
            WHERE Nazev = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $kategorie["nazev"]);
    $stmt->execute();
    $res = $stmt->get_result();
    if (mysqli_num_rows($res) != 0) {
        echo "exist";
        exit();
    }
    $sql = "INSERT INTO kategorie (Nazev)
            VALUE (?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $kategorie["nazev"]);

    if (!$stmt->execute()) {
        echo "0";
        exit();
    }

    echo "1";
    exit();
} elseif ($kategorie["funkce"] == "vyrobce") {
    $sql = "SELECT Nazev 
                FROM vyrobce
                WHERE Nazev = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $kategorie["nazev"]);
    $stmt->execute();
    $res = $stmt->get_result();
    if (mysqli_num_rows($res) != 0) {
        echo "exist";
        exit();
    }
    echo "1";

}
