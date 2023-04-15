<?php
    const MyConst = true;

    require "../pomoc/connection.php";
    if (isset($_POST["ID_R"])) {
        $conn = DbCon();
        $positive = array();
        $negative = array();
        foreach ($_POST["positive"] as $item) {
            if ($item != null && $item != "") {
                $positive[] = $item;
            }
        }
        $positive = json_encode($positive, JSON_UNESCAPED_UNICODE);

        foreach ($_POST["negative"] as $item) {
            if ($item != null && $item != "") {
                $negative[] = $item;
            }
        }
        $negative = json_encode($negative, JSON_UNESCAPED_UNICODE);

        $sql = "UPDATE recenze 
                SET Hodnoceni = '{$_POST["rating"]}'
                    ,Kladne = '$positive'
                    ,Zaporne = '$negative'
                    ,Popis = '{$_POST["zkusenost"]}'
                WHERE ID_R = {$_POST["ID_R"]} ";

        if (!mysqli_query($conn, $sql)) {
            print_r("Omlováme se něco se nepovedlo");
        }
        mysqli_close($conn);
        header('Location: /uzivatel/recenze_uz.php');
    }