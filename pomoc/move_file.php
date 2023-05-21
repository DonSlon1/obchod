<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['safa']) || !$_SESSION['safa']) {
    echo "csrf_token";
    exit();
} else {
    unset($_SESSION['safa']);
}
header('Content-type:image/*');
if ((!defined('MyConst'))) {
    if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
        header('Location: ../error/Method-Not-Allowed.php');
        exit;
    }
}

const MyConst = true;

$suces = move_uploaded_file($_FILES["file"]["tmp_name"], '../images/' . $_FILES["file"]["name"]);
if (!$suces) {
    require "connection.php";
    if (isset($_SESSION["ID_O"])) {
        $con = DbCon();
        $sql = "DELETE FROM recenze 
                    WHERE Obrazek = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $_SESSION["ID_O"]);
        $stmt->execute();
        unset($_SESSION["ID_O"]);
    }
}
echo($suces);
