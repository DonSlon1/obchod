<?php
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    header('Location: ../error/Method-Not-Allowed.php');
    exit;
}
require "connection.php";
$con = DbCon();
$request = json_decode(file_get_contents('php://input'), true);
$ressoult = array();
$sql = "SELECT Nazev , H_Obrazek , ID_P 
        FROM predmety 
        WHERE Nazev LIKE ?
        LIMIT 5";
$stmt = mysqli_prepare($con, $sql);
$search = "%" . $request["search"] . "%";
mysqli_stmt_bind_param($stmt, 's', $search);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

$ressoult["predmet"] = mysqli_fetch_all($res, ASSERT_ACTIVE);


print_r(json_encode($ressoult, JSON_UNESCAPED_UNICODE));