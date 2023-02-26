<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/product.css" type="text/css"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css" type="text/css" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php
    include "connection.php";
    include "navigace.php";
    if (session_status() !== 2){
        session_start();
    }
    navigace();

?>
<div class="container mt-5">
    <h2>Shopping Cart</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $conn = DbCon();
            $basket = array();
            if (isset($_SESSION["basket"])) {
                $basket = json_decode($_SESSION["basket"],true);
            }

            foreach ($basket as $item) {
                $sql = "SELECT H_Obrazek,Nazev FROM predmety WHERE ID_P='{$item["Id_p"]}'";
                $item_data = mysqli_fetch_assoc(mysqli_query($conn,$sql));
                $Id_P = $item["Id_p"];
                echo ('
            <tr>
                <td>
                    <!-- Product image -->
                    <div class="d-flex align-items-center" >
                        <div style="height: 100px ; max-height: 100px" class="d-flex align-items-center">
                            <a  href="http://localhost/Obchod/produkt.php?ID_P='.$item["Id_p"].'">
                                <img src="images/'.$item_data["H_Obrazek"].'" alt="Product 1" style="width: 100px">
                            </a>
                        </div>
                        <a  href="http://localhost/Obchod/produkt.php?ID_P='.$item["Id_p"].'">
                            <span class="ml-3">'.$item_data["Nazev"].'</span>
                        </a>
                        
                    </div>
                </td>
                <td class="text-center align-middle" >
                    <!-- Product image -->
                    
                        <span  >'.$item["Cena"].',-</span>
                    
                </td>

                <td class="text-center align-middle">
                   
                    <input type="number" class="form-control"  min="0" oninput="validity.valid||(value=\'\')" onchange="update_basket(\''.$item["Id_p"].'\' , this)" value="'.$item["Pocet"].'">
                </td>
                <td class="text-center align-middle">'.$item["Cena"]*$item["Pocet"].',-</td>
            </tr>');
            }
        ?>

        </tbody>
    </table>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Checkout</button>

    <div class="modal  fade " id="delete_item" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <span class="m-auto">Odebrat zboží z košíku?</span>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <button type="button"  class="btn btn-secondary w-100" id="Save">Neodebrat</button>
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

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"  crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="js/global_funcion.js"></script>
<script src="js/login.js"></script>
<script src="js/Add_To_cart.js"></script>
<script src="js/basket.js"></script>
</body>

</html>