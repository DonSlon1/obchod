<?php
if ((!defined('MyConst'))) {
    if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
        header('HTTP/1.0 405 ');
        exit;
    }
}
const MyConst = true;

require "connection.php";
$smazani = json_decode(file_get_contents('php://input'), true);

$conn = DbCon();
if (array_key_exists("ID_R", $smazani)) {
    $sql = "SELECT Obrazek FROM recenze WHERE ID_R='{$smazani["ID_R"]}'";

    $res = mysqli_fetch_all(mysqli_query($conn, $sql), ASSERT_ACTIVE);

    foreach ($res as $re) {
        if (file_exists("../images/{$re["Obrazek"]}") && $re["Obrazek"] != "") {
            unlink("../images/{$re["Obrazek"]}");
        }
    }


    $sql = "DELETE FROM recenze WHERE ID_R='{$smazani["ID_R"]}'";

    if (!mysqli_query($conn, $sql)) {
        echo "1";
        exit();
    }
    echo "0";
}
