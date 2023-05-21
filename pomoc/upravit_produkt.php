<?php

if (!array_key_exists("vlasnoti", $_POST)) {
    header('Location: ../error/Method-Not-Allowed.php');
    exit;
}
const MyConst = true;

require "connection.php";
require "funkce.php";
$conn = DbCon();
$id_p = $_POST["ID_P"];
$error = 0;
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if (array_key_exists("vlasnoti", $_POST) && $_SESSION["role"] == "Admin") {
    $vlastnosti = $_POST["vlasnoti"];
    $json_parametry = array();
    getParametry($vlastnosti, $json_parametry);
    $vyrobce = $_POST["vyrobce"] ?? 0;
    $kategorie = $_POST["kategorie"] ?? 0;

    $sql = "UPDATE  `predmety` 
                SET  `Nazev` = ? 
                , `Popis` = ?
                , `Cena_Bez_DPH` = ? 
                , `Parametry` = ? 
                , `ID_K` = ?
                , `ID_V` = ?
                WHERE ID_P = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsiii", $_POST["nazev"], $_POST["popis"], $_POST["cena"], $json_parametry, $kategorie, $vyrobce, $id_p);
    $stmt->execute();
    if (!$stmt->execute()) {
        $error = 1;
        echo "\"Something went wrong! :(";
    }


}

mysqli_close($conn);

if (!$error && $id_p != null) {
    header("Location: /produkt?ID_P=" . $id_p);
}


