<?php

    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    $volba = json_decode(file_get_contents('php://input'), true);
    if (!empty($volba)) {
        if ($volba["funkce"] == "zadat") {
            zadat_platbu($volba["zpusob_platby"]);
        } else if ($volba["funkce"] == "ziskat") {
            ziskat_platbu(true);
        }
    }


    function ziskat_platbu(bool $prepinac = false) : array
    {
        $RESPONSE = array();
        $zpusob = -1;
        if (array_key_exists("platba", $_SESSION)) {
            $zpusob = $_SESSION["platba"];
            $RESPONSE["checked"] = true;
            $RESPONSE["id_checked"] = $zpusob;
        } else {
            $RESPONSE["checked"] = false;
        }
        $kos_doprava["Dobirka"] = '<span>
                            <img src="svg/dobirka.svg" alt="dobirka" class="kos-moznosti">
                            Dobírkou
                            
                        </span>';
        $kos_doprava["Karta-online"] = '<span>
                            <img src="svg/karta.svg" alt="Karta-online" class="kos-moznosti">
                            Kartou online
                            
                        </span>';

        $kos_doprava["bankovni-prevod"] = '<span>
                            <img src="svg/bankovni-prevod.svg" alt="dobirka" class="kos-moznosti">
                            bankovni-prevod
                            
                        </span>';


        $doprava["Dobirka"] = '<label for="Dobirka">
                    <input type="radio" name="platba" value="Dobirka" id="Dobirka" required>
                    <span>
                                Dobírkou
                                <img src="svg/dobirka.svg" alt="dobirka" class="ob-moznosti">
                            </span>
                </label>
                ';

        $doprava["Karta-online"] = '<label for="Karta-online">
                    <input type="radio" name="platba" value="Karta-online" id="Karta-online" required>
                    <span>
                                Kartou online
                                <img src="svg/karta.svg" alt="Karta-online" class="ob-moznosti">
                            </span>
                </label>
                ';

        $doprava["bankovni-prevod"] = '<label for="bankovni-prevod">
                    <input type="radio" name="platba" value="bankovni-prevod" id="bankovni-prevod" required>
                    <span>
                                bankovni-prevod
                                <img src="svg/bankovni-prevod.svg" alt="bankovni-prevod" class="ob-moznosti">
                            </span>
                </label>
                ';

        $RESPONSE["html"] = '<h2>Vyberte Platbu</h2>';

        $RESPONSE["kosik_html"] = '<h6>Platba :</h6>';

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
    function zadat_platbu(string $zpusob) : void
    {

        $_SESSION["platba"] = $zpusob;
    }