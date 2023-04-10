<?php

if ((!defined('MyConst'))) {
    if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
        header('HTTP/1.0 405 ');
        exit;
    }
}

function getParametry(mixed $vlastnosti, array &$json_parametry): void
{
    foreach ($vlastnosti as $index => $item) {

        $pomoc_array = array();
        if ($item == "") {
            continue;
        }
        foreach ($_POST[$index . "N"] as $poradi => $name) {
            if ($name != "" && $_POST[$index . "J"][$poradi] != "") {
                $pomoc_array[htmlspecialchars($name, ENT_QUOTES)] = htmlspecialchars($_POST[$index . "J"][$poradi], ENT_QUOTES);
            }
        }
        $json_parametry[htmlspecialchars($item, ENT_QUOTES)] = $pomoc_array;
    }
    $json_parametry = (json_encode($json_parametry, JSON_UNESCAPED_UNICODE));
}


function overeni_uzivatele(): void
{
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION["role"] != "Admin") {
            print_r($_SESSION);
            header('HTTP/1.0 405 ');
            exit;
        }
    } else {
        print_r($_SESSION);

        header('HTTP/1.0 405 ');
        exit;
    }
}