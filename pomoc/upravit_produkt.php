<?php

const MyConst = true;

require "connection.php";
require "funkce.php";
$conn = DbCon();
$id_p = $_POST["ID_P"];
$error = 0;

if (array_key_exists("vlasnoti", $_POST)) {
    $vlastnosti = $_POST["vlasnoti"];
    $json_parametry = array();
    getParametry($vlastnosti, $json_parametry);


    $sql = "UPDATE  `predmety` SET  `Nazev` = '{$_POST["nazev"]}' , `Popis` = '{$_POST["popis"]}' , `Cena_Bez_DPH` = {$_POST["cena"]} , `Parametry` = '$json_parametry' WHERE ID_P = {$id_p}";
    if (!mysqli_query($conn, $sql)) {
        $error = 1;
        echo "\"Something went wrong! :(";
        return "error";
    }


}

mysqli_close($conn);

if (!$error && $id_p != null) {
    header("Location: /produkt?ID_P=" . $id_p);
}


