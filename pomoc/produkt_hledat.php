<?php
const MyConst = true;

require "connection.php";
require "funkce.php";

$conn = DbCon();
$res = vyhledani_predmetu($conn, $_GET, null, 20) ?? "[]";
echo json_encode($res);


