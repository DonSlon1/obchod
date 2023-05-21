<?php
if ((!defined('MyConst'))) {
    if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
        header('Location: ../error/Method-Not-Allowed.php');
        exit;
    }
}

require "connection.php";
$conn = DbCon();
$email = json_decode(file_get_contents('php://input'), true);
if (array_key_exists("email", $email)) {
    $email = $email["email"];
    $sql = "SELECT Email 
                FROM uzivatel 
                WHERE Email= ? ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($result);
    if (0 == $num_rows) {
        echo "1";
    } else {
        echo "0";
    }
} else {
    echo "error";
}