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
        $kos_doprava["osobni_odber"] = '<span>
                            osobni_odber
                        </span>';

        $doprava["osobni_odber"] = '<label for="osobni_odber">
                    <input type="radio" name="platba" value="osobni_odber" id="osobni_odber">
                    <span>
                                osobni_odber
                            </span>
                </label>
                ';


        $RESPONSE["html"] = '<h2>Vyberte Platbu</h2>';

        $RESPONSE["kosik_html"] = '<h6>Platba</h6>';

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