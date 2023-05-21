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

function sql_get_idp(mysqli $conn, string $sql, int $id_p): mysqli_result
{
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_p);
    $stmt->execute();
    return $stmt->get_result();

}

$conn = DbCon();
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if (array_key_exists("ID_P", $smazani) && $_SESSION["role"] == "Admin") {

    $sql = "SELECT Obrazek 
                FROM obrazky 
                WHERE ID_P = ?";

    $res = sql_get_idp($conn, $sql, $smazani["ID_P"]);
    $res = mysqli_fetch_all($res, ASSERT_ACTIVE);

    foreach ($res as $re) {
        if (file_exists("../images/{$re["Obrazek"]}") && $re["Obrazek"] != "") {
            unlink("../images/{$re["Obrazek"]}");
        }
    }


    $sql = "DELETE FROM obrazky 
                WHERE ID_P = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $smazani["ID_P"]);
    if (!$stmt->execute()) {
        echo "1";
        exit();
    }

    $sql = "SELECT Obrazek 
                FROM recenze 
                WHERE ID_P = ?";

    $res = sql_get_idp($conn, $sql, $smazani["ID_P"]);
    $res = mysqli_fetch_all($res, ASSERT_ACTIVE);

    foreach ($res as $re) {
        if (file_exists("../images/{$re["Obrazek"]}") && $re["Obrazek"] != "") {
            unlink("../images/{$re["Obrazek"]}");
        }
    }


    $sql = "DELETE FROM recenze 
                WHERE ID_P = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $smazani["ID_P"]);
    if (!$stmt->execute()) {
        echo "1";
        exit();
    }

    $sql = "DELETE FROM objednavka_predmet 
                WHERE ID_P = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $smazani["ID_P"]);
    if (!$stmt->execute()) {
        echo "1";
        exit();
    }

    $sql = "SELECT H_Obrazek 
                FROM predmety 
                WHERE ID_P = ?";
    $res = sql_get_idp($conn, $sql, $smazani["ID_P"]);
    $res = mysqli_fetch_all($res, ASSERT_ACTIVE);

    foreach ($res as $re) {
        if (file_exists("../images/{$re["H_Obrazek"]}") && $re["H_Obrazek"] != "")
            unlink("../images/{$re["H_Obrazek"]}");
    }

    $sql = "DELETE FROM predmety 
                WHERE ID_P = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $smazani["ID_P"]);
    if (!$stmt->execute()) {
        echo "1";
        exit();
    }

    echo "0";
}
