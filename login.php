<?php

    require "pomoc/connection.php";
    require "pomoc/randomstring.php";
    $conn = DbCon();
    /**
     * @method set_cookies()
     * @param string $ID_U id uživatele který má být přihlášený
     * @param string $role zadá jaké pravomoce má uživatel
     * @return void
     */

    function set_cookie(string $ID_U, string $role) : void
    {

        $_SESSION["logged_in"] = true;
        $_SESSION["user_id"] = $ID_U;
        $_SESSION["role"] = $role;

    }

    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_POST = json_decode(file_get_contents('php://input'), true);
    if (!empty($_POST)) {


        if ($_POST["log_reg"] == "login") {
            $email = $_POST["email"];
            $Password = $_POST["Password"];
            $sql = "SELECT Email FROM uzivatel WHERE Email= '$email' ";
            if (1 == mysqli_num_rows(mysqli_query($conn, $sql))) {
                $sql = "SELECT Password,ID_U,Role FROM uzivatel WHERE Email= '$email' ";
                $res = (mysqli_query($conn, $sql)->fetch_assoc());
                if (password_verify($Password, $res["Password"])) {

                    set_cookie($res["ID_U"], $res["Role"]);
                    echo "good";
                } else {
                    echo "notexist";
                }
            } else {
                echo "notexist";
            }
        } else if ($_POST["log_reg"] == "registration") {

            $email = $_POST["email"];


            $sql = "SELECT Email FROM uzivatel WHERE Email= '$email' ";
            if (0 == mysqli_num_rows(mysqli_query($conn, $sql))) {
                if ($_POST["Password"] == "") {

                    echo "emptypassword";
                } else {
                    $Password = password_hash($_POST["Password"], PASSWORD_BCRYPT);
                    $jmeno = $_POST["jmeno"];
                    $prijmeni = $_POST["prijmeni"];
                    $Ulice = $_POST["Ulice"];
                    $Mesto = $_POST["Mesto"];
                    $PSC = $_POST["PSC"];
                    $Telefon = $_POST["Telefon"];


                    $sql = "INSERT INTO adresa ( Mesto, Ulice, PSC) VALUE ('$Mesto','$Ulice','$PSC')";
                    mysqli_query($conn, $sql);
                    $ID_A = mysqli_insert_id($conn);

                    $ID_U = generateRandomString(10)."_".uniqid(generateRandomString(10).time(), true);
                    $sql = "INSERT INTO uzivatel (ID_U, Jmeno, Prijmeni, Email,Telefon, Role, Password,ID_A) VALUE ('$ID_U','$jmeno','$prijmeni','$email',$Telefon,'Uzivatel','$Password',$ID_A)";
                    mysqli_query($conn, $sql);

                    set_cookie($ID_U, "Uzivatel");
                    echo "good_reg";
                }
            } else {
                echo "email_nonempty";
            }
        } else if ($_POST["log_reg"] == "logout") {
            unset($_SESSION["logged_in"]);
            unset($_SESSION["user_id"]);
            unset($_SESSION["role"]);

        }
    }

    return 11;

