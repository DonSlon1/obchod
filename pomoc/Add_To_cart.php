<?php


$_POST = json_decode(file_get_contents('php://input'), true);
if (empty($_POST)) {
    header('Location: ../error/Method-Not-Allowed.php');
    exit;
}
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
header('Content-Type: application/json');
function pocet_itemu(): void
{
    $pocet = 0;
    foreach (json_decode($_SESSION["basket"], true) as $value) {

        $pocet += $value["Pocet"];

    }
    echo($pocet);
}

if ($_POST["function"] === "exist") {

    if (isset($_SESSION["basket"])) {
        echo 1;
    } else {
        echo 0;
    }
    return;
} elseif ($_POST["function"] === "new") {

    $_SESSION["basket"] = $_POST["data"];

    pocet_itemu();
    return;
} elseif ($_POST["function"] == "add") {
    $existuje = false;
    $decoded_sesion = json_decode($_SESSION["basket"], true);
    foreach ($decoded_sesion as $key => $value) {
        if ($value["Id_p"] === $_POST["data"][0]["Id_p"]) {

            $decoded_sesion[$key]["Pocet"] = $value["Pocet"] + $_POST["prid_ubr"];
            $_SESSION["basket"] = json_encode($decoded_sesion);
            $existuje = true;
            break;
        }

    }
    if (!$existuje) {
        $json_array_first = json_decode($_SESSION["basket"], true);
        $_SESSION["basket"] = json_encode(array_merge($json_array_first, $_POST["data"]));

    }
    pocet_itemu();
} elseif ($_POST["function"] === "get") {
    if (session_status() === PHP_SESSION_ACTIVE) {
        if (isset($_SESSION["basket"])) {
            pocet_itemu();
        }
    } else {
        session_start();
    }
} elseif ($_POST["function"] === "delete") {

    if (isset($_SESSION["basket"])) {
        $decoded_sesion = json_decode($_SESSION["basket"], true);
        foreach ($decoded_sesion as $index => $item) {
            if ($item["Id_p"] === $_POST["Id_p"]) {
                unset($decoded_sesion[$index]);
                break;
            }
        }
        $_SESSION["basket"] = json_encode($decoded_sesion);

    }
} elseif ($_POST["function"] === "update") {

    if (isset($_SESSION["basket"])) {
        $decoded_sesion = json_decode($_SESSION["basket"], true);
        foreach ($decoded_sesion as $key => $item) {
            if ($item["Id_p"] === $_POST["Id_p"]) {
                $decoded_sesion[$key]["Pocet"] = $_POST["Pocet"];
                break;
            }
        }
        $_SESSION["basket"] = json_encode($decoded_sesion);

    }
}