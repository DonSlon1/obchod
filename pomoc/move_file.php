<?php

    header('Content-type:image/*');
    if ((!defined('MyConst'))) {
        if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
            header('Location: ../error/Method-Not-Allowed.php');
            exit;
        }
    }
    echo(move_uploaded_file($_FILES["file"]["tmp_name"], '../images/'.$_FILES["file"]["name"]));
