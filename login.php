<?php


require "pomoc/connection.php";
require "pomoc/randomstring.php";
$conn = DbCon();
/**
 * @method set_cookies()
 * @param string $ID_U id uživatele který má být přihlášený
 * @param string $keepLogin určí jestli po ukončení js sesion se má uživatel odhlásit
 * @return void
 */

function set_cookie(string $ID_U , string $keepLogin) :void
{

    if ($keepLogin == 1){
        setcookie('logged_in', true, [
                'expires' => time() + (86400 * 30),
                'path' => '/',
                'samesite' => 'Lax']
        ); // Set the login status


        setcookie('user_id', $ID_U, [
                'expires' => time() + (86400 * 30),
                'path' => '/',
                'samesite' => 'Lax']
        ); // Set the user ID
    }else{
        setcookie('logged_in', true, [
                'expires' => 0,
                'path' => '/',
                'samesite' => 'Lax']
        ); // Set the login status


        setcookie('user_id', $ID_U, [
                'expires' => 0,
                'path' => '/',
                'samesite' => 'Lax']
        ); // Set the user ID
    }
}

$_POST=json_decode(file_get_contents('php://input'),true);
if (!empty($_POST)){



    if ($_POST["log_reg"]=="login"){
        $email = $_POST["email"];
        $Password = $_POST["Password"];
        $sql = "SELECT * FROM uzivatel WHERE Email= '$email' ";
        if (1==mysqli_num_rows(mysqli_query($conn,$sql))){
            $sql = "SELECT Password,ID_U FROM uzivatel WHERE Email= '$email' ";
            $res = (mysqli_query($conn,$sql)->fetch_assoc());
            if (password_verify($Password,$res["Password"])){

                set_cookie($res["ID_U"] ,$_POST["keepLogin"]);
                echo "good";
            }else{
                echo "notexist";
            }
        }else{
            echo "notexist";
        }
    }
    else if ($_POST["log_reg"]=="registration"){

        $email = $_POST["email"];


        $sql = "SELECT * FROM uzivatel WHERE Email= '$email' ";
        if (0==mysqli_num_rows(mysqli_query($conn,$sql))){
            if ($_POST["confirmPassword"]=="" && $_POST["Password"]==""){

                echo "emptypassword";
            }
            else if ($_POST["confirmPassword"]==$_POST["Password"]){
                $Password = password_hash($_POST["Password"],PASSWORD_BCRYPT);
                $jmeno = $_POST["jmeno"];
                $prijmeni = $_POST["prijmeni"];
                $Ulice = $_POST["Ulice"];
                $Mesto = $_POST["Mesto"];
                $PSC = $_POST["PSC"];
                $ID_U=generateRandomString(10)."_".uniqid(generateRandomString(10).time(),true);
                $sql = "INSERT INTO uzivatel (ID_U, Jmeno, Prijmeni, Email, Role, Password) VALUE ('$ID_U','$jmeno','$prijmeni','$email','Uzivatel','$Password')";
                mysqli_query($conn,$sql);
                $sql = "INSERT INTO adresa (ID_U, Mesto, Ulice, PSC) VALUE ('$ID_U','$Mesto','$Ulice','$PSC')";
                mysqli_query($conn,$sql);
                set_cookie($ID_U , $_POST["keepLogin"]);
                echo "good_reg";
            }
            else {
                echo "password!=password";
            }
        }else{
            echo "email_nonempty";
        }
    }else if ($_POST["log_reg"]=="logout"){
        
        setcookie('logged_in', '', [
                'expires' =>time() - 3600,
                'path' => '/',
                'samesite' => 'Lax']
        ); // Set the login status


        setcookie('user_id', null, [
                'expires' =>time() - 3600,
                'path' => '/',
                'samesite' => 'Lax']
        );
    }
}

return  11;

