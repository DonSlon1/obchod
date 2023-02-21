<?php
    include "connection.php";
    include "randomstring.php";
    $con = DbCon();
    $data = array();
    $_POST=json_decode(file_get_contents('php://input'),true);
    if (array_key_exists('user_id',$_COOKIE)){
        $id_u=$_COOKIE['user_id'];
    }
    else{
        $id_u=2;
    }

    $id_p = $_POST['ID_P'];
    $popis = $_POST['zkusenost'];
    $positive = json_encode($_POST['positive']);
    $negative = json_encode($_POST['negative']);
    $rating = $_POST['rating'];

    if ( !empty($rating) && 5>=$rating && $rating>=1) {
        if (array_key_exists("img_type",$_POST)) {
            $ID_O = generateRandomString(10) . "_" . generateRandomString(50) . "." . (mb_substr($_POST["img_type"], mb_stripos($_POST["img_type"], "/") + 1));
            while (file_exists('./images/'.$ID_O)){
                $ID_O = generateRandomString(10) . "_" . generateRandomString(50) . "." . (mb_substr($_POST["img_type"], mb_stripos($_POST["img_type"], "/") + 1));
            }
            $data['ID_O'] = $ID_O;
            $sql = "INSERT INTO recenze(`ID_U`,`ID_P`,`Popis`,`Hodnoceni`,`Kladne`,`Zaporne`,`Obrazek`) VALUES('$id_u','$id_p','$popis',$rating,'$positive','$negative','$ID_O')";

        }
        else{
            $sql = "INSERT INTO recenze(`ID_U`,`ID_P`,`Popis`,`Hodnoceni`,`Kladne`,`Zaporne`) VALUES('$id_u','$id_p','$popis',$rating,'$positive','$negative')";

        }

        mysqli_query($con, $sql);
        $data['response'] = 'good';


    }else{
        $data['response'] = 'rating';
    }
    echo json_encode($data);