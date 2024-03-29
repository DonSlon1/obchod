<!doctype html>
<html lang="cs">
<head>
    <meta name="description" content="Košík">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="images/icon-apple.png">
    <link rel="manifest" href="manifest.json"/>
    <link rel="stylesheet" href="style/product.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css" type="text/css" crossorigin="anonymous">
    <link rel="stylesheet" href="style/basket_nav.css">
    <link rel="stylesheet" href="style/basket.css">

    <script src="service-worker.js"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>

    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php
const MyConst = true;

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Zpracování formuláře
    $_SESSION['form_data'] = $_POST;
    header('Location: ./checkout');
    exit;
}

require "pomoc/connection.php";
require "pomoc/navigace.php";
require "pomoc/funkce.php";
navigace(0);

?>

<div class="container h_container  mt-5">
    <ul class="navigace">
        <li class="active_li">
            <a class="nepodtrh">
                <span>Košík</span>
            </a>
        </li>
        <li>
            <a class="nepodtrh">
                <span>Doprava a pladba</span>
            </a>
        </li>
        <li>
            <a class="nepodtrh">
                <span>Souhrn objednávky</span>
            </a>
        </li>
    </ul>

    <?php
    overeni_kosik();
    $token = bin2hex(random_bytes(32));
    $_SESSION["csrf_token"] = $token;
    ?>
    <form action="basket" method="post" autocomplete="off">
        <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo $token ?>">
        <div>

            <?php
            $cena_celkem = 0;
            $conn = DbCon();
            $basket = array();
            if (isset($_SESSION["basket"])) {
                $basket = json_decode($_SESSION["basket"], true);
            }
            $count = 0;
            foreach ($basket as $item) {
                $sql = "SELECT H_Obrazek,Nazev FROM predmety WHERE ID_P=?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $item["Id_p"]);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $item_data = mysqli_fetch_assoc($result);
                $Id_P = $item["Id_p"];
                $cena_celkem += $item["Cena"] * $item["Pocet"];
                echo('
            <div class="kosik_div">
                
                <div class="kosik_informace">  
                    <div>   
                        <a class="obrazek" href="produkt.php?ID_P=' . $item["Id_p"] . '">
                            <img  src="images/' . $item_data["H_Obrazek"] . '" alt="' . htmlspecialchars($item_data["Nazev"]) . '" >
                        </a>      
                        <div class="nazev_item">        
                            <a class="sede"  href="produkt?ID_P=' . $item["Id_p"] . '">
                                 <span class="ml-3">' . htmlspecialchars($item_data["Nazev"]) . '</span>
                            </a>
                        </div>
                        
                        <div class=" align-middle pocet">
                            
                            <input type="hidden" name="polozka[' . $count . '][Obrazek]" value="' . $item_data["H_Obrazek"] . '">
                            <input type="hidden" name="polozka[' . $count . '][Cena]" value="' . $item["Cena"] . '">
                            <input type="hidden" name="polozka[' . $count . '][ID_P]" value="' . $item["Id_p"] . '">
                            <input type="hidden" name="polozka[' . $count . '][Nazev]" value="' . htmlspecialchars($item_data["Nazev"]) . '">
                            <input type="number"  class="form-control numberstyle" name="polozka[' . $count . '][pocet]"  min="0" max="999" step="1" pattern="[0-9]{1,3}"  onchange="update_basket(\'' . $item["Id_p"] . '\' , this)"  value="' . $item["Pocet"] . '">
                       
                        </div>
                        
                        <div class=" align-middle cena cena_za_kus" >
                             <!-- Product image -->
                             
                            <span  >' . number_format($item["Cena"], thousands_separator: ' ') . ' Kč/ks</span>
                             
                        </div>
            
                        
                        <div class="text-center align-middle cena cena_celkem">' . number_format($item["Cena"] * $item["Pocet"], thousands_separator: ' ') . ' Kč</div>
                    </div> 
                </div>
            </div>');
                $count++;
            }

            ?>
        </div>
        <?php
        echo(' <p class="text-right final_cena">
                    Celkem k úhradě: <strong>' . number_format($cena_celkem, thousands_separator: ' ') . ' Kč</strong>
                </p>
             ')
        ?>
        <div class="Checkout">
            <a href="/" class="sede">Zpět do obchodu</a>
            <button type="submit" class="btn btn-primary btn-lg" id="del-pay-frm__submit">Checkout</button>
        </div>

    </form>
    <div class="modal  fade " id="delete_item" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
         data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <span class="m-auto">Odebrat zboží z košíku?</span>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <button type="button" class="btn btn-secondary w-100" id="Save">Neodebrat</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary w-100" id="Remove">Odebrat zboží</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script src="/js/basket.js"></script>
</body>

</html>