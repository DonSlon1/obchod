<?php

    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
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


        $kos_doprava["pobocka"] = '<span>
                            <img class="kos-moznosti" src="images/icon-maskable.png" alt="prodejna">
                            Naše prodejna
                        </span>';

        $kos_doprava["posta"] = '<span>
                                <img class="kos-moznosti" src="svg/ceska-posta.svg" alt="Česká pošta">
                                Česká pošta
                            </span>';

        $kos_doprava["dpo"] = '<span>
            DPO
            <img class="kos-moznosti" src="svg/dpd.svg" alt="DPO">
        </span>';


        $doprava["pobocka"] = '<label for="pobocka">
                        <input type="radio" name="doprava" id="pobocka" value="pobocka">
                        <span>
                            Naše prodejna
                            <img class="ob-moznosti" src="images/icon-maskable.png" alt="prodejna">
                        </span>
                    </label>
                ';

        $doprava["posta"] = '<label for="posta">
                            <input type="radio" name="doprava" value="posta" id="posta">
                            <span>
                                Česká pošta
                                <img class="ob-moznosti" src="svg/ceska-posta.svg" alt="Česká pošta">
                            </span>
                            
                        </label>
                ';
        $doprava["dpo"] = '<label for="dpo">
                            <input type="radio" name="doprava" value="dpo" id="dpo">
                            <span>
                                DPO
                                <img class="ob-moznosti" src="svg/dpd.svg" alt="DPO">
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

