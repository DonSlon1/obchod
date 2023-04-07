<!doctype html>
<html lang="en">

<head>
    <meta name="description" content="Dodaci udaje">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="images/icon-apple.png">
    <link rel="manifest" href="manifest.json"/>
    <link rel="stylesheet" href="style/product.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css" type="text/css" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION["role"] != "Admin") {
            print_r($_SESSION);
            header('HTTP/1.0 405 ');

            exit;
        } else {
            echo "<p>Hello {$_SESSION['logged_in']}.</p>";
            echo "<p>You entered {$_SESSION['user_id']} as your password.</p>";
        }
    } else {
        print_r($_SESSION);
        header('HTTP/1.0 405 ');
        exit;
    }
?>
<a href="zadani-souboru.php">zadnání souboru</a>

</body>
</html>