<?php

    if ((!defined('MyConst'))) {
        if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
            header('HTTP/1.0 405 ');
            exit;
        }
    }

    function error_msg(?string $type = 'Unknown') : void
    {
        if ($type == 'Login') {
            echo "<div class='error-kosik error-user' >
                    <div>
                        <span><b>Omlováme se ale pro přístup na tuto stránku musíte být přihlášen</b></span>
                        <div>
                            <a class='btn btn-primary' href='' data-toggle='modal' data-target='#LoginModal'>Přihlásit se</a>
                            <a class='btn btn-primary' href='/'>Zpět do Obchodu</a>
                        </div>
                    </div>
                </div>";
        } elseif ($type == 'Neexistuje') {
            echo "<div class='error-kosik error-user' >
                    <div>
                        <span><b>Omlováme se ale vypadá to že tento produkt nexistuje</b></span>
                            <a class='btn btn-primary' href='/'>Zpět do Obchodu</a>
                    </div>
                </div>";
        } else {
            echo "<div class='error-kosik error-user' >
                    <div>
                        <span><b>Omlováme se ale něco se nepovedlo</b></span>
                        <div>
                            <a class='btn btn-primary' href='/'>Zpět do Obchodu</a>
                        </div>
                    </div>
                </div>";
        }

    }

    function getParametry(mixed $vlastnosti, array &$json_parametry) : void
    {
        foreach ($vlastnosti as $index => $item) {

            $pomoc_array = array();
            if ($item == "") {
                continue;
            }
            foreach ($_POST[$index."N"] as $poradi => $name) {
                if ($name != "" && $_POST[$index."J"][$poradi] != "") {
                    $pomoc_array[htmlspecialchars($name, ENT_QUOTES)] = htmlspecialchars($_POST[$index."J"][$poradi], ENT_QUOTES);
                }
            }
            $json_parametry[htmlspecialchars($item, ENT_QUOTES)] = $pomoc_array;
        }
        $json_parametry = json_encode($json_parametry, JSON_UNESCAPED_UNICODE);
    }


    function overeni_uzivatele() : void
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

    function overeni_kosik() : void
    {

        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $error = false;
        $conn = DbCon();

        if (!array_key_exists("basket", $_SESSION)) {
            $error = true;

        } else if ($_SESSION["basket"] == "[]") {
            $error = true;
        } else {
            $overene_itemy = array();
            if (isset($_SESSION["basket"])) {
                $basket = json_decode($_SESSION["basket"], true);

                foreach ($basket as $item) {
                    $sql = "SELECT H_Obrazek,Nazev FROM predmety WHERE ID_P='{$item["Id_p"]}'";

                    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    if ($res != null) {
                        $overene_itemy[] = $item;
                    }
                }
                $_SESSION["basket"] = json_encode($overene_itemy, JSON_UNESCAPED_UNICODE);
            }

            if (isset($_SESSION["form_data"]["polozka"])) {
                $overene_itemy = array();
                $basket = $_SESSION["form_data"]["polozka"];

                foreach ($basket as $item) {
                    $sql = "SELECT H_Obrazek,Nazev FROM predmety WHERE ID_P='{$item["ID_P"]}'";

                    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    if ($res != null) {
                        $overene_itemy[] = $item;
                    }
                }
                $_SESSION["form_data"]["polozka"] = $overene_itemy;
            }
        }

        if ($_SERVER["SCRIPT_NAME"] != "/basket.php" && $error) {
            $_SESSION["site_error"] = true;
            header('Location: ./basket.php');
            exit();
        }
        if ($error) {
            if (array_key_exists("site_error", $_SESSION)) {
                if ($_SESSION["site_error"]) {
                    unset($_SESSION["site_error"]);
                    echo "<div class='error-msg'>
                    <div>
                        <img alt='error'  src='/svg/krizek.svg'>
                        V průběhu nákupu došlo ke změnám, je potřeba znovu nastavit údaje. 
                    </div>
                    <img  id='close-element' alt='zavrit' src='svg/close.svg'>
                    </div>    
                    <script src='/js/bs-pre.js'></script>
                    ";
                }
            }

            echo "<div class='error-kosik' >
                    <span>Váš nákupní <b>košík je prázdný.</b></span>
                    <a class='btn btn-primary' href='/'>Zpět do Obchodu</a>
                </div>
                <script src='/js/global_funcion.js'></script>
                <script src='/js/login.js'></script>
                <script src='/js/basket.js'></script>";

            exit();
        }
    }

    function prihlaseny_uzivatel() : void
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION["user_id"])) {
            error_msg('Login');
            echo "       
                <script src='/js/global_funcion.js'></script>
                <script src='/js/login.js'></script>
                <script src='/js/basket.js'></script>
            ";
            exit();
        }
    }