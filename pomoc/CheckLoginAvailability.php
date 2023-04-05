<?php
require "connection.php";
$conn = DbCon();
$email = json_decode(file_get_contents('php://input'), true);
if (array_key_exists("email", $email)) {
    $email = $email["email"];
    $sql = "SELECT Email FROM uzivatel WHERE Email= '$email' ";
    if (0 == mysqli_num_rows(mysqli_query($conn, $sql))) {
        echo "1";
    } else {
        echo "0";
    }
} else {
    echo "error";
}