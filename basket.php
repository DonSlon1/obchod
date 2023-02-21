<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
    include "navigace.php";

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
        <tr>
            <td>
                <!-- Product image -->
                <div class="d-flex align-items-center">
                    <img src="predmety-H_Obrazek(1).jpg" alt="Product 1" width="100">
                    <span class="ml-3">Product 1</span>
                </div>
            </td>
            <td>$50.00</td>
            <td>
                <input type="number" class="form-control" value="1">
            </td>
            <td>$50.00</td>
        </tr>
        <tr>
            <td>
                <!-- Product image -->
                <div class="d-flex align-items-center">
                    <img src="predmety-H_Obrazek(1).jpg" alt="Product 2" width="100">
                    <span class="ml-3">Product 2</span>
                </div>
            </td>
            <td>$30.00</td>
            <td>
                <input type="number" class="form-control" value="1">
            </td>
            <td>$30.00</td>
        </tr>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td>$80.00</td>
        </tr>
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Checkout</button>
</div>
</body>
</html>