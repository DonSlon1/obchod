<?php
$_POST=json_decode(file_get_contents('php://input'),true);
session_start();

if ($_POST["function"] === "exist") {

    if (isset($_SESSION["basket"])){
        echo 1;
    }else{
        echo 0;
    }
    return;
}elseif ($_POST["function"] === "new"){

    $_SESSION["basket"] = $_POST["data"];
    $pocet = 0;

    foreach (json_decode($_SESSION["basket"],true) as $value){
        $pocet+=$value["Pocet"];

    }
    echo($pocet);
    return;
}elseif ($_POST["function"] ===  "add"){
    $existuje = false;
    $decoded_sesion =json_decode($_SESSION["basket"],true);
    foreach ($decoded_sesion as $key => $value){
        if ($value["Id_p"] === $_POST["data"][0]["Id_p"]){
            $decoded_sesion[$key]["Pocet"] = $value["Pocet"] + 1;
            $_SESSION["basket"] = json_encode($decoded_sesion);
            $existuje = true;
            break;
        }

    }

    if(!$existuje) {
        $json_array_first = json_decode($_SESSION["basket"], true);
        $_SESSION["basket"] = json_encode(array_merge($json_array_first, $_POST["data"]));

    }
    $pocet = 0;
    foreach (json_decode($_SESSION["basket"],true) as $value){
        $pocet+=$value["Pocet"];

    }
    echo($pocet);
}