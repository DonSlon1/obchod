<?php
    const MyConst = true;

    require "connection.php";
    require "funkce.php";

    $conn = DbCon();

    echo json_encode(vyhledani_predmetu($conn, $_GET, null, 20));


