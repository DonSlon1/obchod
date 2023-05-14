<?php
    const MyConst = true;

    require "connection.php";
    require "funkce.php";
    require "randomstring.php";

    $con = DbCon();
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    overeni_uzivatele();

    $sql = "SELECT Nazev 
                FROM vyrobce
                WHERE Nazev = ?";
    if (mysqli_num_rows(mysqli_execute_query($con, $sql, [$_POST["new_vyrobce"]])) != 0) {
        $_SESSION["success"] = false;
        header('Location: '.$_SERVER["HTTP_REFERER"]);
    }

    if (empty($_FILES) || $_FILES["vyr_obr"]["error"] != 0) {
        $_SESSION["success"] = false;
        header('Location: '.$_SERVER["HTTP_REFERER"]);
    }

    $ext = pathinfo($_FILES["vyr_obr"]["name"], PATHINFO_EXTENSION);
    $name = generateRandomString(10).".".$ext;
    while (file_exists("../images/".$name)) {
        $name = generateRandomString(10).".".$ext;
    }
    move_uploaded_file($_FILES["vyr_obr"]["tmp_name"], "../images/".$name);
    $sql = "INSERT INTO vyrobce (Nazev, Obrazek)
                VALUES (?,?)";
    mysqli_execute_query($con, $sql, [$_POST["new_vyrobce"], $name]);
    $_SESSION["success"] = true;
    header('Location: '.$_SERVER["HTTP_REFERER"]);
