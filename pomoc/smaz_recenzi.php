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
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (array_key_exists("ID_R", $smazani) && isset($_SESSION["user_id"])) {

    $povoleni = false;
    if ($_SESSION["role"] != "Admin") {
        $sql = "SELECT ID_U 
                FROM recenze 
                WHERE ID_R=? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $smazani["ID_R"]);
        $stmt->execute();
        $res = $stmt->get_result();
        $res = mysqli_fetch_row($res);
        if ($res[0] == $_SESSION["user_id"]) {
            $povoleni = true;
        }
    } else {
        $povoleni = true;
    }

    if (!$povoleni) {
        echo "1";
        exit();
    }

    $sql = "SELECT Obrazek 
                FROM recenze 
                WHERE ID_R=? ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $smazani["ID_R"]);
    $stmt->execute();
    $res = $stmt->get_result();
    $res = mysqli_fetch_all($res, ASSERT_ACTIVE);

    foreach ($res as $re) {
        if (file_exists("../images/{$re["Obrazek"]}") && $re["Obrazek"] != "") {
            unlink("../images/{$re["Obrazek"]}");
        }
    }


    $sql = "DELETE FROM recenze 
                WHERE ID_R=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $smazani["ID_R"]);
    if (!$stmt->execute()) {
        echo "1";
        exit();
    }
    echo "0";
}
