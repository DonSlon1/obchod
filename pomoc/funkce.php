<?php

    if ((!defined('MyConst'))) {
        if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
            header('Location: ../error/Method-Not-Allowed.php');
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
        } elseif ($type == 'Good') {
            echo "<div class='error-kosik error-user' >
                    <div>
                        <span><b>Vaše změny byly uloženy úspěšně</b></span>
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

                header('Location: ../error/Forbidden.php');
                exit;
            }
        } else {
            header('Location: ../error/Forbidden.php');
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
                    $sql = "SELECT H_Obrazek,Nazev 
                        FROM predmety 
                        WHERE ID_P= ?";

                    $res = mysqli_fetch_assoc(mysqli_execute_query($conn, $sql, [$item["Id_p"]]));
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
                    $sql = "SELECT H_Obrazek,Nazev 
                        FROM predmety 
                        WHERE ID_P=?";

                    $res = mysqli_fetch_assoc(mysqli_execute_query($conn, $sql, [$item["ID_P"]]));
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
            header('Location: ../error/Unauthorized.php');
            exit;
        }
    }

    /**
     * @param mysqli $conn
     * @param array|null $get
     * @param array $cena
     * @param int $num_results_on_page
     * @return array
     */
    function vyhledani_predmetu(mysqli $conn, ?array $get, ?array $cena, int $num_results_on_page) : array
    {

        $min_search = $get["Min"] ?? $cena["Min"];
        $max_search = $get["Max"] ?? $cena["Max"];

        $nazev_search = $get["Nazev"] ?? '';
        $nazev_search = '%'.$nazev_search.'%';
        $vyrobce_search = isset($get['Vyrobce']) ? explode(',', $get['Vyrobce']) : array();
        $hodnoceni = $get["Hodnoceni"] ?? 0;


        $parametry = array();
        $parametry[] = $nazev_search;

        //    parametry pro vyrobce
        $placeholders = array_fill(0, count($vyrobce_search), '?');
        $placeholders = implode(',', $placeholders);
        foreach ($vyrobce_search as $value) {
            $parametry[] = $value;
        }
        $sql_cena = '';
        if (!is_null($min_search) && !is_null($max_search)) {
            $sql_cena = 'Cena_Bez_DPH BETWEEN ? AND ?';
            $parametry[] = $min_search;
            $parametry[] = $max_search;

        } elseif (!is_null($min_search)) {
            $sql_cena = 'Cena_Bez_DPH > ?';
            $parametry[] = $min_search;

        } elseif (!is_null($max_search)) {
            $sql_cena = 'Cena_Bez_DPH < ?';
            $parametry[] = $max_search;
        }
        $parametry[] = $hodnoceni;

        $sql_vyrobce = "";
        if (!empty($vyrobce_search)) {
            $sql_vyrobce = "p.ID_V IN ($placeholders) AND";
        }

        //stránkování
        $sql = "SELECT COUNT(*) AS Pocet
            FROM (SELECT COUNT(*) AS Pocet
                    FROM predmety p
                    LEFT JOIN recenze r on p.ID_P = r.ID_P
                    WHERE p.Nazev LIKE ? AND
                          $sql_vyrobce
                          $sql_cena
                    GROUP BY p.ID_P
                    HAVING COALESCE(SUM(r.Hodnoceni) / COUNT(r.ID_R),0) >= ?
                ) as po";

        $total_pages = mysqli_fetch_row(mysqli_execute_query($conn, $sql, $parametry))[0] ?? 0;

        $page = isset($get['Stranka']) && is_numeric($get['Stranka']) ? $get['Stranka'] : 1;
        $calc_page = ($page - 1) * $num_results_on_page;
        $parametry[] = $calc_page;
        $parametry[] = $num_results_on_page;

        $sql = "SELECT p.ID_P AS  ID_P ,p.Nazev AS Nazev, Cena_Bez_DPH AS Cena ,H_Obrazek,
                COALESCE(SUM(r.Hodnoceni) / COUNT(r.ID_R),0) AS Hodnocení ,p.ID_V ,p.Popis AS Popis
                FROM predmety p
                LEFT JOIN recenze r on p.ID_P = r.ID_P 
                WHERE
                    p.Nazev LIKE ? AND
                    $sql_vyrobce
                    $sql_cena
                GROUP BY p.ID_P , p.Nazev
                HAVING Hodnocení >= ?
                ORDER BY p.Nazev
                LIMIT ?,?
                ";
        $predmety = mysqli_fetch_all(mysqli_execute_query($conn, $sql, $parametry), ASSERT_ACTIVE);

        $predmetysave = array();
        foreach ($predmety as $item) {
            $predmetysave[] = array_map('htmlspecialchars', $item);
        }

        return [$predmetysave, $total_pages];

    }
