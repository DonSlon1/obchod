<?php
    const MyConst = true;

    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_POST["email_dou"]) && isset($_SESSION["platba"]) && isset($_SESSION["doprava"]) && isset($_SESSION["form_data"]["polozka"])) {
        require "connection.php";


        $conn = DbCon();
        $sql = "INSERT INTO dodaci_udaje (Email, Telefon, Jmeno, Přijmeni, Mesto, Ulice_Cp, PSC) 
                VALUES ('{$_POST["email_dou"]}','{$_POST["tel_dou"]}','{$_POST["jmeno_dou"]}','{$_POST["prijmeni_dou"]}','{$_POST["ulice_dou"]}','{$_POST["obec_dou"]}',{$_POST["psc_dou"]} )";

        if (mysqli_query($conn, $sql)) {
            $id_du = mysqli_insert_id($conn);
            if (isset($_SESSION["user_id"])) {
                $sql = "INSERT INTO objednavka (ID_U, ID_DU , doprava ,platba) 
                        VALUES ('{$_SESSION["user_id"]}',$id_du ,'{$_SESSION["doprava"]}','{$_SESSION["platba"]}')";
            } else {
                $sql = "INSERT INTO objednavka (ID_DU , doprava ,platba) 
                        VALUES ($id_du ,'{$_SESSION["doprava"]}','{$_SESSION["platba"]}')";

            }
            if (mysqli_query($conn, $sql)) {
                $id_o = mysqli_insert_id($conn);
                foreach ($_SESSION["form_data"]["polozka"] as $item) {
                    $sql = "INSERT INTO objednavka_predmet (ID_OB, ID_P, Poce_kusu)
                            VALUES ($id_o , {$item["ID_P"]},{$item["pocet"]} )";
                    mysqli_query($conn, $sql);
                }
            }
            unset($_SESSION["form_data"]);
            unset($_SESSION["doprava"]);
            unset($_SESSION["platba"]);
            unset($_SESSION["basket"]);
            unset($_POST);
        }

        mysqli_close($conn);
        header('Location: ../uspech.php');

    } else {
        header('Location: ../basket.php');
    }