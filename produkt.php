<!doctype html>
<html lang="en">
<head>
    <meta name="description" content="Produkt">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="images/icon-apple.png">
    <link rel="manifest" href="manifest.json"/>
    <title>Document</title>

    <link rel="stylesheet" href="style/product.css" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css" type="text/css">


</head>
<div>

    <?php

    require "pomoc/connection.php";
    require "pomoc/navigace.php";

    navigace();
    $conn = DbCon();
    $sql1 = "SELECT * FROM predmety WHERE ID_P = '" . $_GET["ID_P"] . "'";
    $sql2 = "SELECT * FROM obrazky WHERE ID_P = '" . $_GET["ID_P"] . "'";


    $images = mysqli_query($conn, $sql1);
    $himage = $images->fetch_assoc();


    $images = mysqli_query($conn, $sql2);


    echo('
<div class="container h_container  mt-5">
  <div class="row">
    <!-- Image gallery -->
    <div class="col-md-6">
      <div id="product-gallery" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <li data-target="#product-gallery" data-slide-to="0" class="active"></li>');

    for ($i = 1; $i <= mysqli_num_rows($images); $i++) {
        echo '<li data-target="#product-gallery" data-slide-to="' . $i . '"></li>';
    }

    echo('
        </ol>
        <!-- Images -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container d-flex justify-content-center align-items-center" style="height: 525px">
                <img src="./images/' . $himage['H_Obrazek'] . '" alt="' . htmlspecialchars($himage["Nazev"]) . '" class="d-block image_galery  cursor_pointer"  data-toggle="modal" data-target="#images-modal">
            </div>
          </div>');
    $ii = $images;
    while ($image = $images->fetch_assoc()) {
        echo('<div class="carousel-item">
                        <div class="container d-flex justify-content-center align-items-center" style="height: 525px">
                            <img src="./images/' . $image['Obrazek'] . '" alt="' . htmlspecialchars($himage["Nazev"]) . '" class="d-block image_galery  cursor_pointer"  data-toggle="modal" data-target="#images-modal">
                        </div>
                   </div>');
    }
    echo('
            
            </div>
            </div>'
    );

    ?>
    <!-- Controls -->
    <div class="carousel-controls">
        <a class="carousel-control-prev" href="#product-gallery" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#product-gallery" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!--    * div ve kterém se  zobrazovat obrázky od produktu ve velkém-->
    <div class="modal fade" id="images-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered div_obraz" role="document">
            <div class="modal-content">
                <div>
                    <div class="container obrazek_ccontainer">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="close mr-2 mt-2" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div id="big-product-gallery" class="carousel slide" data-ride="false">
                                    <div class="carousel-inner " style="height: 70vh">
                                        <?php

                                        echo('
                                        <div class="carousel-item active vertical-center">
                                            <div class="container d-flex justify-content-center align-items-center" >
                                                <img src="./images/' . $himage['H_Obrazek'] . '" alt="' . htmlspecialchars($himage["Nazev"]) . '" class="d-block   img-dislpay"  style="max-width: 50vw" >
                                            </div>
                                        </div>');
                                        $images = mysqli_query($conn, $sql2);
                                        while ($image = $images->fetch_assoc()) {

                                            echo('
                                        <div class="carousel-item  vertical-center ">
                                            <div class="container d-flex justify-content-center align-items-center"  >
                                                <img src="./images/' . $image['Obrazek'] . '" alt="' . htmlspecialchars($himage["Nazev"]) . '" class="d-block  img-dislpay"  style="max-width: 50vw ">
                                            </div>
                                        </div>');
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- Controls -->
                                <div class="carousel-controls">
                                    <a class="carousel-control-prev" href="#big-product-gallery" role="button"
                                       data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#big-product-gallery" role="button"
                                       data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                            <div class="col w-fitcontent mw-fitcontent  overflow-auto pt-2 lg-background" id="sideBar">
                                <?php

                                echo('
                            <div class="p-2 ">
                            <div class=" d-flex  align-items-center w-fitcontent borde bg-white p-1 blue-border" >
                                <img src="./images/' . $himage['H_Obrazek'] . '" alt="' . htmlspecialchars($himage["Nazev"]) . '" class="d-block mx-auto image_galery  cursor_pointer" style="width: 150px" data-slide-to="0" data-target="#big-product-gallery">
                            </div>
                            </div>');
                                $images = mysqli_query($conn, $sql2);
                                $index = 1;
                                while ($image = $images->fetch_assoc()) {

                                    echo('
                            <div class="p-2 ">
                            <div class=" d-flex  align-items-center w-fitcontent borde bg-white p-1" >
                                <img src="./images/' . $image['Obrazek'] . '" alt="' . htmlspecialchars($image["Nazev"]) . '" class="d-block mx-auto   cursor_pointer" style="width: 150px" data-slide-to="' . $index . '" data-target="#big-product-gallery" >
                            </div>
                            </div>');
                                    $index = $index + 1;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
<!-- Product info -->
<div class="col-md-6">
    <?php
    $nazev = $himage['Nazev'];
    $popis = $himage['Popis'];
    $cena = $himage['Cena_Bez_DPH'];
    echo('
                <input id="cena" type="hidden" value="' . $cena . '">
                <h2>' . $nazev . '</h2>
                <p>' . $popis . '</p>
                <h3>' . number_format($cena, thousands_separator: ' ') . ' Kč</h3>')
    ?>
    <form class="preventDefault">
        <!-- <div class="form-group">
           <label for="size">Size</label>
           <select class="form-control" id="size">
             <option>Small</option>
             <option>Medium</option>
             <option>Large</option>
           </select>
         </div>
         <div class="form-group">
           <label for="color">Color</label>
           <select class="form-control" id="color">
             <option>Red</option>
             <option>Blue</option>
             <option>Green</option>
           </select>
         </div>-->

        <div class="col pl-0 pr-1">
            <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="add_To_cart()">Přidat do košíku
            </button>
        </div>

        <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered " role="document">
                <div class="modal-content align-content-center p-3">
                    <div class="w-auto m-auto">
                        <i class="icon_check check p-3"></i>
                    </div>
                    <span class="green_icon align-self-center font22">
                                Zboží bylo ůspěšně přidíno do košíku
                            </span>
                </div>
            </div>
        </div>

    </form>
</div>
</div>


<!--    navigace mezi informacemi-->
<ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
    <li class="nav-item">

        <a class="nav-link active sede" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
           aria-selected="true">Parametry</a>
    </li>
    <li class="nav-item">
        <a class="nav-link sede" id="profile-tab" data-toggle="tab" href="#Hodnocení" role="tab" aria-controls="profile"
           aria-selected="false">Recenze</a>
    </li>
    <li class="nav-item">
        <a class="nav-link sede" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
           aria-selected="false">Foto a video</a>
    </li>
</ul>
<div class="tab-content pl-0 pr-0 pt-3" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="container pl-0 pr-0 big_in_small">
            <div class="row">
                <div class="col-md-12">
                    <h2>Product Parameters</h2>

                    <table class="table table-bordered">
                        <tbody>
                        <?php
                        $sql2 = "SELECT Parametry FROM predmety WHERE ID_P = '" . $_GET["ID_P"] . "'";
                        $res = mysqli_fetch_all(mysqli_query($conn, $sql2));
                        $res = $res[0][0];

                        $produkt_parameters = json_decode($res, true);
                        foreach ($produkt_parameters as $key => $parameter) {
                            echo '<tr class="table-primary">
                                        <th colspan="2">' . $key . '</th>
                                     </tr>';
                            foreach ($parameter as $index => $item) {
                                echo '<tr>
                                            <th>' . $index . '</th>
                                            <td>' . $item . '</td>
                                          </tr>';
                            }

                        }


                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <div class="tab-pane fade pl-0 pr-0" id="Hodnocení" role="tabpanel" aria-labelledby="Hodnocení-tab">


        <?php
        //Hodnoceni
        $sql2 = "SELECT Hodnoceni FROM recenze WHERE ID_P = '" . $_GET["ID_P"] . "'";
        $hod_query = mysqli_query($conn, $sql2);
        $hod = 0;
        $pocet = mysqli_num_rows($hod_query);
        $pocethod = array("1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0);
        while ($rov1 = $hod_query->fetch_assoc()) {
            $pocethod[$rov1['Hodnoceni']] = $pocethod[$rov1['Hodnoceni']] + 1;
            $hod = $hod + $rov1['Hodnoceni'];
        }
        if ($pocet == 0 || $hod == 0) {
            $vls = 0.0;
        } else {
            $vls = round($hod / $pocet, 1);
        }
        if ($pocet == 0) {
            $veta = "Zatím nikdo nehodnotil";
        } elseif ($pocet == 1) {
            $veta = "Hodnotil 1 zákazník";
        } elseif ($pocet <= 4) {
            $veta = "Hodnotili " . $pocet . " zákazníci";
        } else {
            $veta = "Hodnotilo " . $pocet . " zákazníků";
        }

        if ($pocet != 0) {
            $pocethod["5"] = ($pocethod["5"]) * (100 / $pocet);
            $pocethod["4"] = ($pocethod["4"]) * (100 / $pocet);
            $pocethod["3"] = ($pocethod["3"]) * (100 / $pocet);
            $pocethod["2"] = ($pocethod["2"]) * (100 / $pocet);
            $pocethod["1"] = ($pocethod["1"]) * (100 / $pocet);
        } else {
            $pocethod["5"] = 0;
            $pocethod["4"] = 0;
            $pocethod["3"] = 0;
            $pocethod["2"] = 0;
            $pocethod["1"] = 0;
        }
        echo('
            <div class="container pl-0 pr-0 ">
                <div class="row">
                    <div class="col-md-auto w-fitcontent519">
                        <div class="container w-fitcontent519">
                            <div class="row ml-auto mr-auto mb-2 w-fitcontent519" >
                                 <h1 class="m-auto">' . str_replace(".", ",", $vls) . '</h1>
                             </div>
                            <div class="row ml-auto mr-auto mb-2 w-fitcontent519">
                                 <div class="star-rating-wrapper ml-auto mr-auto" title="Hodnocení ' . $vls . '/5">
                                    <div class="empty-stars-element"></div>
                                    <div class="stars-element" style="width:' . ($vls * 20) . '%"></div>
                                 </div>
                             </div>
                             <div class="mt-2 ml-auto mr-auto mb-2 text-center w-fitcontent519">
                                ' . $veta . '
                            </div>
                            <div class="row ml-auto mr-auto mb-2 w-fitcontent519">
                            <span data-toggle="modal" data-target="#myModal1" class="btn btn-primary btn-lg btn-block modal-recenze"><i class="icon-pencil"></i> Napsat recenzi</span>   
                            </div>
                             
                        </div>
                    </div>
                    <div class="col-md-auto w-fitcontent519">
                        
                        <div class="container h-100 w-fitcontent">
                            
                            <div class="row-cols-1 grid h-100">
                                <div class="col d-flex text-center"><span class="m-auto">5</span><img src="svg/star.svg" alt="Star" class="m-auto Star20 " data-value="1" >
                                    <div class="bottom-backg m-auto ">
                                        <div class="top-backg" style="width: ' . ($pocethod["5"]) . '%"></div>
                                    </div>
                                </div>

                                
                                <div class="col d-flex text-center"><span class="m-auto">4</span><img src="svg/star.svg" alt="Star" class="m-auto Star20 " data-value="1" >
                                    <div class="bottom-backg m-auto">
                                        <div class="top-backg" style="width: ' . ($pocethod["4"]) . '%"></div>
                                    </div>
                                </div>

                                <div class="col d-flex text-center"><span class="m-auto">3</span><img src="svg/star.svg" alt="Star" class="m-auto Star20 " data-value="1" >
                                    <div class="bottom-backg m-auto">
                                        <div class="top-backg" style="width: ' . ($pocethod["3"]) . '%"></div>
                                    </div>
                                </div>

                                <div class="col d-flex text-center"><span class="m-auto">2</span><img src="svg/star.svg" alt="Star" class="m-auto Star20 " data-value="1" >
                                    <div class="bottom-backg m-auto">
                                        <div class="top-backg" style="width: ' . ($pocethod["2"]) . '%"></div>
                                    </div>
                                </div>

                                <div class="col d-flex text-center"><span class="m-auto">1</span><img src="svg/star.svg" alt="Star" class="m-auto Star20 " data-value="1" >
                                    <div class="bottom-backg m-auto">
                                        <div class="top-backg" style="width: ' . ($pocethod["1"]) . '%"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                       
                    </div>
                    
                </div>
            </div>
          <div class="container mt-5 pl-0 pr-0">
            <div class="row">
                <div class="col-md-6 minw-100">');

        $sql2 = "SELECT U.Jmeno , U.Prijmeni , R.Hodnoceni , R.Popis ,R.Zaporne,R.Kladne,R.Obrazek  FROM recenze R ,uzivatel U WHERE R.ID_U=U.ID_U AND ID_P =  '" . $_GET["ID_P"] . "'";
        $hod_query = mysqli_query($conn, $sql2);
        $modalnumber = 0;
        while ($rov1 = $hod_query->fetch_assoc()) {

            echo('
                         <div class="mb-3 border-bottom pb-2">
                         <h5>' . $rov1["Jmeno"] . ' ' . $rov1["Prijmeni"] . ' </h5>
                          <div class="d-flex align-items-center mb-3">
                            <div class="star-rating-wrapper" title="Hodnocení ' . $rov1["Hodnoceni"] . '/5">
                                <div class="empty-stars-element"></div>
                                <div class="stars-element" style="width:' . ($rov1["Hodnoceni"] * 20) . '%"></div>
                            </div>
                          </div>
                          <p class="mb-0 minw-100 text-break">' . $rov1["Popis"] . '</p>
                          <div class="container">
                          <div class="row ">
                                <div class="col pr-5 mt-2">');
            if (json_decode($rov1["Kladne"]) != null) {
                foreach (json_decode($rov1["Kladne"]) as $value) {
                    echo('<div class="row text-break">
                                             <div class="col mw-fitcontent p-0">
                                              <svg class="rev-icon pos-icon pr-1" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 11h-3v3c0 .55-.45 1-1 1s-1-.45-1-1v-3H8c-.55 0-1-.45-1-1s.45-1 1-1h3V8c0-.55.45-1 1-1s1 .45 1 1v3h3c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
                                                    </svg>
                                              </div>
                                              <div class="col pl-1">
                                                ' . $value . '
                                              </div>
                                            </div>');
                }
            }
            echo('
                                </div>
                                <div class="col mt-2">');
            if (json_decode($rov1["Zaporne"]) != null) {
                foreach (json_decode($rov1["Zaporne"]) as $value) {
                    echo('<div class="row text-break">
                                                <div class="col mw-fitcontent p-0">
                                                <svg class="rev-icon neg-icon pr-1" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 11H8c-.55 0-1-.45-1-1s.45-1 1-1h8c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
                                                </svg>
                                                </div>
                                                <div class="col pl-1">
                                                ' . $value . '
                                                </div>
                                            </div>');
                }
            }
            echo('</div>
                            </div>
                            </div>');
            if ($rov1["Obrazek"] != null) {
                $modalnumber = $modalnumber + 1;
                echo('
                                <div class="container pt-2">
                                <div class="row">
                                    <img alt=" " class="recenze_obrazek cursor_pointer" src="images/' . $rov1["Obrazek"] . '" data-target="#modalimg' . $modalnumber . '" data-toggle="modal">
                                </div>
                                </div>
                                <div class="modal fade" id="modalimg' . $modalnumber . '" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered " role="document" >
                                        <div class="modal-content p-3" >
                                            <img alt=" " src="images/' . $rov1["Obrazek"] . '">
                                            <button type="button" class="close mr-2 mt-2 close-button " data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" style="color: rgba(0, 0, 0, 0.87);">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                ');
            }
            echo('</div>
                          ');

        }
        ?>
        <!-- Reviews -->


    </div>
</div>
</div>


</div>
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>


<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered recenze" role="document">
        <div class="modal-content recenze_body" style="width: 90%">
            <div>

                <button type="button" class="close mr-2 mt-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pl-4 pr-4 pb-4">
                <div class="row row-cols-1">
                    <div style="max-width: fit-content;margin: auto;">
                        <?php
                        $sql1 = " SELECT Nazev FROM predmety WHERE ID_P= '" . $_GET["ID_P"] . "'";
                        $res = mysqli_query($conn, $sql1);
                        $Nazev = $res->fetch_assoc();
                        echo '<div class="m-auto" style="max-width: fit-content">
                                          <img src="./images/' . $himage['H_Obrazek'] . '" alt="' . htmlspecialchars($himage["Nazev"]) . '" class="mh-100 d-inline img-fluid " style="height: 10em;">
                                      </div>
                                      <div class="w-100 text-center pt-2 pb-2 text-muted">
                                      
                                       ' . $Nazev["Nazev"] . '
                                       </div>'
                        ?>

                        <h2 class="text-info">Jak jste se zbožím spokojen?</h2>
                        <div id="rating" class="pt-2 m-auto">
                            <img src="svg/star.svg" alt="Star" class="starrs50" data-value="1">
                            <img src="svg/star.svg" alt="Star" class="starrs50" data-value="2">
                            <img src="svg/star.svg" alt="Star" class="starrs50" data-value="3">
                            <img src="svg/star.svg" alt="Star" class="starrs50" data-value="4">
                            <img src="svg/star.svg" alt="Star" class="starrs50" data-value="5">
                        </div>
                    </div>
                </div>

                <form id="recene" method="post" enctype="multipart/form-data" onsubmit="recenze()">
                    <div class="container mt-4 ">
                        <?php
                        echo '<input type="hidden" name="ID_P" id="ID_P" value="' . $_GET["ID_P"] . '">'
                        ?>

                        <input type="hidden" id="rating-value" name="rating">
                        <div class="row">
                            <div class="col mb-4 mr-4">
                                <div class="row">
                                    <label class="text-success">Popište klady</label>
                                    <div class="container p-3 bb" id="klady">
                                        <div class="row ">
                                            <div class="col pr-0 fitcont float-right">
                                                <svg class="rev-icon pos-icon " focusable="false" viewBox="0 0 24 24"
                                                     aria-hidden="true">
                                                    <path
                                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 11h-3v3c0 .55-.45 1-1 1s-1-.45-1-1v-3H8c-.55 0-1-.45-1-1s.45-1 1-1h3V8c0-.55.45-1 1-1s1 .45 1 1v3h3c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
                                                </svg>
                                            </div>
                                            <div class="col m-auto">
                                                    <textarea class="form-control border-0 p-0 "
                                                              oninput="auto_grow(this) " id="positive"
                                                              name="positive[]" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="row">
                                    <label class="text-danger">Popište zápory</label>
                                    <div class="container p-3 bb" id="zapory">
                                        <div class="row ">
                                            <div class="col pr-0 fitcont float-right">
                                                <svg class="rev-icon neg-icon " focusable="false" viewBox="0 0 24 24"
                                                     aria-hidden="true">
                                                    <path
                                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 11H8c-.55 0-1-.45-1-1s.45-1 1-1h8c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
                                                </svg>
                                            </div>
                                            <div class="col">
                                                    <textarea class="form-control border-0 p-0"
                                                              oninput="auto_grow(this)" id="negative"
                                                              name="negative[]" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container m-2">
                                <div class="row">
                                    <label for="zkusenost">Popište svou zkušenost s produktem (nepovinné)</label>
                                    <textarea class="form-control  text" oninput="auto_grow(this)"
                                              id="zkusenost"
                                              name="zkusenost" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="container pl-0">
                                <div class="container m-2 w-max-100 w-fitcontent border  " id="ddforimg"
                                     style="display: none">
                                    <div class="row p-1 " id="plforimg">

                                    </div>
                                </div>
                                <label for="img" class="container m-2 border cursor_pointer w-100">
                                    <input type="file" name="img" id="img" accept="image/jpeg,image/png"
                                           style="display: none">
                                    <div class="row w-100 p-2">
                                            <span><img alt="upload" src="svg/cloud-arrow-up-solid.svg"
                                                       style="width: 2em;height: auto "></span>
                                        <div class="ml-2">
                                            <span class="mw-fitcontent blue_text ">
                                                Přidat fotografii
                                            </span>
                                            <span class="mw-fitcontent">
                                                <small>Maximálně 1 soubor (JPEG, PNG), Maximálně 10 MB</small>
                                            </span>
                                        </div>
                                    </div>

                                </label>
                            </div>

                        </div>
                        <div class="row">

                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit Review</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
</div>

<script src="service-worker.js"></script>
<script src="node_modules/axios/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script src="js/produkt.js"></script>
<script src="js/global_funcion.js"></script>
<script src="js/login.js"></script>
<script src="js/Add_To_cart.js"></script>

</html>

