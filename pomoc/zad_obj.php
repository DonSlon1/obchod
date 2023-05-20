<?php
const MyConst = true;

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
// TODO přidat csrf_token
if (isset($_POST["email_dou"]) && isset($_SESSION["platba"]) && isset($_SESSION["doprava"]) && isset($_SESSION["form_data"]["polozka"])) {
    require "connection.php";


    $conn = DbCon();
    $sql = "INSERT INTO dodaci_udaje (Email, Telefon, Jmeno, Přijmeni, Mesto, Ulice_Cp, PSC) 
                VALUES (?,?,?,?,?,?,? )";

    if (mysqli_execute_query($conn, $sql, [$_POST["email_dou"], $_POST["tel_dou"], $_POST["jmeno_dou"], $_POST["prijmeni_dou"], $_POST["ulice_dou"], $_POST["obec_dou"], $_POST["psc_dou"]])) {
        $id_du = mysqli_insert_id($conn);

        $id_u = $_SESSION["user_id"] ?? null;

        $sql = "INSERT INTO objednavka (ID_U,ID_DU , doprava ,platba) 
                    VALUES (?,?,?,?)";

        if (mysqli_execute_query($conn, $sql, [$id_u, $id_du, $_SESSION["doprava"], $_SESSION["platba"]])) {
            $id_o = mysqli_insert_id($conn);
            foreach ($_SESSION["form_data"]["polozka"] as $item) {
                $sql = "INSERT INTO objednavka_predmet (ID_OB, ID_P, Poce_kusu)
                            VALUES (?,?,?)";
                mysqli_execute_query($conn, $sql, [$id_o, $item["ID_P"], $item["pocet"]]);
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