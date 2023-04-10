<?php

const MyConst = true;
require "connection.php";
require "randomstring.php";
require "funkce.php";
$conn = DbCon();
$error = 0;
$id_p = null;
if (array_key_exists("vlasnoti", $_POST)) {
    $vlastnosti = $_POST["vlasnoti"];
    $json_parametry = array();
    $H_OB = generateRandomString(6) . '.' . pathinfo($_FILES["h_obr"]["full_path"], PATHINFO_EXTENSION);

    getParametry($vlastnosti, $json_parametry);

    if (isset($_FILES["h_obr"]) && $_FILES["h_obr"]["error"] == 0) {
        while (file_exists("../images" . $H_OB)) {
            generateRandomString(6) . '.' . pathinfo($_FILES["h_obr"]["full_path"], PATHINFO_EXTENSION);
        }
        move_uploaded_file($_FILES["h_obr"]["tmp_name"], "../images/" . $H_OB);
    }

    $sql = "INSERT INTO `predmety` ( `Nazev`, `Popis`, `Cena_Bez_DPH`, `H_Obrazek`, `Parametry`) VALUES ('{$_POST["nazev"]}','{$_POST["popis"]}' , {$_POST["cena"]} , '$H_OB' , '$json_parametry')";
    if (!mysqli_query($conn, $sql)) {
        $error = 1;
        echo "\"Something went wrong! :(";
        return "error";
    }

    $id_p = mysqli_insert_id($conn);
    if ($id_p != null) {
        for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
            if ($_FILES["file"]["name"][$i] == "") {
                continue;
            }
            if ($_FILES["file"]["error"][$i] == 0) {
                $nazev_obrazku = generateRandomString(6) . '.' . pathinfo($_FILES["file"]["full_path"][$i], PATHINFO_EXTENSION);

                while (file_exists("../images" . $nazev_obrazku)) {
                    generateRandomString(6) . '.' . pathinfo($_FILES["file"]["full_path"][$i], PATHINFO_EXTENSION);
                }
                move_uploaded_file($_FILES["file"]["tmp_name"][$i], "../images/" . $nazev_obrazku);

                $sql = "INSERT INTO `obrazky` (Obrazek, Nazev, ID_P) VALUES ('$nazev_obrazku' , '{$_FILES["file"]["name"][$i]}' , $id_p)";

                mysqli_query($conn, $sql);
            } else {
                $error = 1;
                echo "s obrázkem " . $_FILES["file"]["name"][$i] . "je něco špatně";
                return "error";
            }
        }
    } else {
        $error = 1;
        echo "nebylo možno vložit zánam do databáze ";
    }

}

mysqli_close($conn);

if (!$error && $id_p != null) {
    header("Location: /produkt?ID_P=" . $id_p);
}


