<?php
    if ((!defined('MyConst'))) {
        if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
            header('Location: ../error/Method-Not-Allowed.php');
            exit;
        }
    }
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    } else {
        $das = 0;
    }

    $volba = json_decode(file_get_contents('php://input'), true);
    if (!empty($volba)) {
        if ($volba["funkce"] == "zadat") {
            zadat_dopravu($volba["zpusob_dopravy"]);
        } else if ($volba["funkce"] == "ziskat") {
            ziskat_dopravu(true);
        } else if ($volba["funkce"] == "reset") {
            if ($volba["dodani"]) {
                if (array_key_exists("doprava", $_SESSION)) {
                    unset($_SESSION["doprava"]);
                }
            }
            if ($volba["platba"]) {
                if (array_key_exists("platba", $_SESSION)) {
                    unset($_SESSION["platba"]);

                }
            }
            print_r($_SESSION);
        }
    }

    function ziskat_dopravu(bool $prepinac = false) : array
    {
        $RESPONSE = array();
        $zpusob = -1;
        if (array_key_exists("doprava", $_SESSION)) {
            $zpusob = $_SESSION["doprava"];
            $RESPONSE["checked"] = true;
            $RESPONSE["id_checked"] = $zpusob;
        } else {
            $RESPONSE["checked"] = false;
        }


        $kos_doprava["posta"] = '<span>
                                <img class="kos-moznosti" src="svg/ceska-posta.svg" alt="Česká pošta">
                                Česká pošta
                            </span>';

        $kos_doprava["dpd"] = '<span>
            <img class="kos-moznosti" src="svg/dpd.svg" alt="dpd">
            DPD
            
        </span>';


        $doprava["posta"] = '<label for="posta">
                            <input type="radio" name="doprava" value="posta" id="posta" required>
                            <span>
                                Česká pošta
                                <img class="ob-moznosti" src="svg/ceska-posta.svg" alt="Česká pošta">
                            </span>
                            
                        </label>
                ';
        $doprava["dpd"] = '<label for="dpd">
                            <input type="radio" name="doprava" value="dpd" id="dpd" required>
                            <span>
                                DPD
                                <img class="ob-moznosti" src="svg/dpd.svg" alt="dpd">
                            </span>
                            
                        </label>
                ';

        $RESPONSE["html"] = '<h2>Vyberte Dopravu</h2>';
        $RESPONSE["kosik_html"] = '<h6>Doprava :</h6>';
        if ($zpusob == -1) {
            foreach ($doprava as $item) {

                $RESPONSE["html"] = $RESPONSE["html"].$item;
            }
        } else {
            $RESPONSE["kosik_html"] = $RESPONSE["kosik_html"].$kos_doprava[$zpusob];
            $RESPONSE["html"] = $RESPONSE["html"].$doprava[$zpusob];
        }
        if ($prepinac) {
            echo json_encode($RESPONSE);
            return [];
        } else {
            return $RESPONSE;
        }
    }


    /**
     * funkce slouzi k tomu aby zadala data o dopravě do lokal sesion storage
     * @param string $zpusob zpusob dopravy
     * @return void
     * */
    function zadat_dopravu(string $zpusob) : void
    {

        $_SESSION["doprava"] = $zpusob;
    }

