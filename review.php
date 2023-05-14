<?php

if ((!defined('MyConst'))) {
    if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
        header('Location: ../error/Method-Not-Allowed.php');
        exit;
    }
}
const MyConst = true;
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require "pomoc/connection.php";
require "pomoc/randomstring.php";

$con = DbCon();
$data = array();
$_POST = json_decode(file_get_contents('php://input'), true);

if (array_key_exists('user_id', $_SESSION)) {
    $id_u = $_SESSION['user_id'];
} else {
    $id_u = 2;
}

$id_p = $_POST['ID_P'];
$popis = $_POST['zkusenost'];
$positive = json_encode($_POST['positive'], JSON_UNESCAPED_UNICODE);
$negative = json_encode($_POST['negative'], JSON_UNESCAPED_UNICODE);
$rating = $_POST['rating'];

if (!empty($rating) && 5 >= $rating && $rating >= 1) {
    if (array_key_exists("img_type", $_POST)) {
        if ($_POST["img_type"] == "image/jpeg" || $_POST["img_type"] == "image/png") {
            $ID_O = generateRandomString(10) . "_" . generateRandomString(50) . "." . (mb_substr($_POST["img_type"], mb_stripos($_POST["img_type"], "/") + 1));
            while (file_exists('./images/' . $ID_O)) {
                $ID_O = generateRandomString(10) . "_" . generateRandomString(50) . "." . (mb_substr($_POST["img_type"], mb_stripos($_POST["img_type"], "/") + 1));
            }
            $data['ID_O'] = $ID_O;
            $sql = "INSERT INTO recenze(`ID_U`,`ID_P`,`Popis`,`Hodnoceni`,`Kladne`,`Zaporne`,`Obrazek`) VALUES(?,?,?,?,?,?,?)";
            mysqli_execute_query($con, $sql, [$id_u, $id_p, $popis, $rating, $positive, $negative, $ID_O]);
        } else {
            $data['response'] = 'type';
            echo json_encode($data);
            mysqli_close($con);
            exit();
        }
    } else {
        $sql = "INSERT INTO recenze(`ID_U`,`ID_P`,`Popis`,`Hodnoceni`,`Kladne`,`Zaporne`) VALUES(?,?,?,?,?,?)";
        mysqli_execute_query($con, $sql, [$id_u, $id_p, $popis, $rating, $positive, $negative]);

    }


    $data['response'] = 'good';


} else {
    $data['response'] = 'rating';
}
echo json_encode($data);
mysqli_close($con);
