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

function set_cookie(string $ID_U, string $role): void
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
        $sql = "SELECT Email,Password,ID_U,Role
                FROM uzivatel WHERE Email= ? ";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if (1 == mysqli_num_rows($res)) {
            $res = mysqli_fetch_assoc($res);
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
        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
            unset($_SESSION['csrf_token']);
            echo "csrf_token";
            exit();
        }

        if ($_SESSION['captcha_text'] != $_POST["Captcha"]) {
            echo "captcha";
            exit();
        } else {
            unset($_SESSION['captcha_text']);
        }
        $email = $_POST["email"];


        $sql = "SELECT Email
                FROM uzivatel WHERE Email= ? ";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if (0 == mysqli_num_rows($res)) {
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


                $sql = "INSERT INTO adresa ( Mesto, Ulice, PSC) 
                        VALUE (?,?,?)";
                $stmt = mysqli_prepare($conn, $sql);
                $stmt->bind_param("ssi", $Mesto, $Ulice, $PSC);
                $stmt->execute();
                $ID_A = $stmt->insert_id;

                $sql = "INSERT INTO uzivatel ( Jmeno, Prijmeni, Email,Telefon, Role, Password,ID_A) 
                            VALUE (  ? , ? , ? ,?,'Uzivatel',?,?)";
                $stmt = mysqli_prepare($conn, $sql);
                $stmt->bind_param("sssssi", $jmeno, $prijmeni, $email, $Telefon, $Password, $ID_A);
                $stmt->execute();
                $ID_U = $stmt->insert_id;

                set_cookie($ID_U, "Uzivatel");
                unset($_SESSION['csrf_token']);
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

