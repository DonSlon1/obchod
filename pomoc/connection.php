<?php

/**
 * funkce pro připojení do databáze
 * @method DbCon()
 * @return mysqli mysqli_connect
 */
function DbCon(): mysqli
{
    $server = 'localhost';
    $dbname = 'shop';
    $user = 'root';
    $pass = 'root';

    $conn = mysqli_connect($server, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;

}
