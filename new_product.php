<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="style/product.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


    <title>Document</title>
</head>
<body>
<?php

require "navigace.php";
require "connection.php";
require "randomstring.php";
$conn = DbCon();
mysqli_set_charset($conn,"utf8mb4");
navigace();

?>

<!-- Add item form -->
<div class="container mt-5">
    <h2>Add Item</h2>
    <form action="new_product.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nazevev">Name</label>
            <input type="text" class="form-control" name="nazevev" id="nazevev">
        </div>
        <div class="form-group">
            <label for="popis">Description</label>
            <textarea class="form-control" name="popis" id="popis" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="Cena">Cena Bez DPH</label>
            <input type="number" class="form-control" name="Cena" id="Cena">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category">
                <option>Clothing</option>
                <option>Electronics</option>
                <option>Home</option>
                <option>Outdoor</option>
                <option>Toys</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image">
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Add Item</button>
    </form>
</div>


<form action="new_product.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Základní vlasnosti</legend>
        <label for="nazevev">Název</label>
        <input id="nazevev" name="nazev" type="text">

        <label for="popis">Popis</label>
        <input id="popis" name="popis" type="text">
    </fieldset>
    <fieldset>
        <legend>Obrázky</legend>
        <div>
            <label for="H_Obrazek">Hlavní Obrázek</label>


            <!--nemenit stejne jako v javscriptu-->
            <input id="H_Obrazek" name="H_Obrazek" type="file" accept="image/*" onchange="nefacha(this)">


            <div id="H_Obrazekpr" class="preview"></div>
        </div>
        <br>
        <div id="galerie"></div>
        <button type="button" onclick="Add_Image()">Add Image</button>


    </fieldset>
    <fieldset>
        <legend>Dalsi Informace</legend>
            <label for="Cena">Cena Bez DPH</label>
            <input id="Cena" name="Cena"  type="text">
        <br>

        Podrobné Informace
        <div id="categorys">

        </div>
        <button type="button" onclick="Add_Category()">Add Category of Parameter</button>
    </fieldset>

    <input type="submit">
</form>
<?php



    //if ((!empty($_FILES["H_Obrazek"]["tmp_name"]) && (!empty($_POST["nazev"]))  && (!empty($_POST["popis"])) && (!empty($_POST["Cena"]))  )){

        if (!empty($_POST["nazev"])) {


            $ActualId=generateRandomString(10)."_".uniqid(generateRandomString(10).time(),true);
            if (getimagesize($_FILES["H_Obrazek"]["tmp_name"])){
                $HOb = generateRandomString(10)."_".generateRandomString(50).".".(mb_substr($_FILES["H_Obrazek"]["type"],mb_stripos($_FILES["H_Obrazek"]["type"],"/")+1));
                while(file_exists('./images/'.$HOb)){
                    $HOb = generateRandomString(10)."_".generateRandomString(50).".".(mb_substr($_FILES["H_Obrazek"]["type"],mb_stripos($_FILES["H_Obrazek"]["type"],"/")+1));
                }

                move_uploaded_file($_FILES["H_Obrazek"]["tmp_name"],'./images/'.$HOb);
                $nazev = $_POST["nazev"];
                $popis = $_POST["popis"];
                $cena = $_POST["Cena"];
                $obj = new stdClass();


                if (!empty($_POST["name_of"])) {


                    foreach ($_POST["name_of"] as $key => $item) {
                        $helpobj = new stdClass();

                        foreach ($_POST[$key . "J"] as $JKey => $value) {
                            $value = addslashes($value);
                            $helpobj->$value = addslashes($_POST[$key . "H"]["$JKey"]);
                        }

                        $item = addslashes($item);
                        $obj->$item = $helpobj;
                    }
                }

                $res = json_encode($obj,JSON_UNESCAPED_UNICODE );
//                print_r($res);

                foreach (json_decode($res) as $key1 => $item) {
                    echo "<br/>" . $key1, "{";
                    foreach ($item as $key => $value) {
                        echo "<br/>", $key . "=" . $value;
                    }
                    echo "} <br/>";
                }

                //NESAHAT NA TO STALE NEVIM JAK TO FUNGUJE DRZI TO JENOM SILOU VULE
                $sql1 = "INSERT INTO `predmety` (`ID_P`, `Nazev`, `Popis`, `Cena_Bez_DPH`, `Hodnoceni`, `H_Obrazek`, `Parametry`) VALUES ('$ActualId', '$nazev', '$popis', '$cena', default, '$HOb', '$res')";

                if (!mysqli_query($conn, $sql1)) {
                    echo "\"Something went wrong! :(";
                }

            }else print_r("falwefwaefqwffsese</br>");



            foreach ($_FILES as $key => $FILE) {

                if (empty($FILE["name"]) || $key == "H_Obrazek") continue;

                if (getimagesize($FILE["tmp_name"])) {

                    $data = generateRandomString(10)."_".generateRandomString(50).".".(mb_substr($FILE["type"],mb_stripos($FILE["type"],"/")+1));
                    while (file_exists('./images/'.$data)){
                        $data = generateRandomString(10)."_".generateRandomString(50).".".(mb_substr($FILE["type"],mb_stripos($FILE["type"],"/")+1));
                    }

                    move_uploaded_file($FILE["tmp_name"],'./images/'.$data);
                    $nazev = $_POST[$key . "name"];
                    echo $key, $nazev, "<br>";
                    $sql3 = "INSERT INTO `obrazky` (`ID_O`, `Obrazek`, `Nazev`, `ID_P`) VALUES (NULL,'$data', '$nazev', '$ActualId')";
                    mysqli_query($conn, $sql3);
                }

            }
        }

?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/new_product.js"></script>

</body>

</html>