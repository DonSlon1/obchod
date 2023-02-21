<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  crossorigin="anonymous" />

    <title>Document</title>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">My Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
            <?php
                    if (array_key_exists("logged_in",$_COOKIE)) {
                        echo('
                    <li class="nav-item">
                    
                        <span class="nav-link">Edit Profile</span>
                     </li>
                     <li class="nav-item" style="margin: auto">
                        <span class="nav-link"  onclick="logout()"><i class="fas fa-sign-out-alt"></i></span>
                        
                     </li>');

                    } else {
                        echo('
                    <li class="nav-item">
                    <span class="nav-link" data-toggle="modal" data-target="#myModal">Login</span>

                        
                     </li>');
                    }

            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Shop Login/Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container mt-5 ">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">


                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div class="tab-pane active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                    <form id="login-form" method="post" onsubmit="login()">
                                        <input type="hidden" name="log_reg" value="login">
                                        <div class="form-group">
                                            <label for="loginEmail">Email address</label>
                                            <input type="email" class="form-control" id="loginEmail" name="email" aria-describedby="emailHelp">
                                            <small id="emailHelpLogin" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="loginPassword">Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" name="Password" class="form-control" id="loginPassword">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="show-password"><i class="fa fa-eye"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="login_keep_logged_in" name="login_keep_logged_in">
                                            <label class="form-check-label" for="login_keep_logged_in">Keep me logged in</label>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block">Log In</button>
                                    </form>
                                </div>

                                <div class="tab-pane" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form id="reg-form" method="post" onsubmit="registration()">
                                        <input type="hidden" name="log_reg" value="registration">
                                        <div class="form-group">
                                            <label for="registerEmail">Email address</label>
                                            <input type="email" class="form-control" name="email" id="registerEmail" aria-describedby="emailHelp">
                                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                        </div>
                                        <div class="form-group">

                                            <label for="registerPassword">Password</label>
                                            <input type="password" name="Password" class="form-control" id="registerPassword">

                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="show-passwordRegister"><i class="fa fa-eye"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="jmeno">Jméno</label>
                                            <input type="text" class="form-control" id="jmeno" name="jmeno" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="prijmeni">Příjmení</label>
                                            <input type="text" class="form-control" id="prijmeni" name="prijmeni" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="Ulice">Ulice</label>
                                            <input type="text" class="form-control" id="Ulice" name="Ulice" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="Mesto">Mesto</label>
                                            <input type="text" class="form-control" id="Mesto" name="Mesto" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="PSC">PSC</label>
                                            <input type="text" class="form-control" id="PSC" name="PSC" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="reg_keep-logged-in" name="reg_keep-logged-in">
                                            <label class="form-check-label" for="reg_keep-logged-in">Keep me logged in</label>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="row g-3 container align-items-center">-->
<!---->
<!--</div>-->



<?php
$server = 'localhost';
$dbname = 'shop';
$user = 'root';
$pass = 'root';

$conn = mysqli_connect($server,$user,$pass,$dbname);
$sql1 = "SELECT * FROM predmety ";

$res = mysqli_query($conn,$sql1);
$myArray=[];
$count = 0;
while ($row = $res->fetch_assoc()) {

    $sql2 = "SELECT * FROM recenze WHERE ID_P = '".$row['ID_P']."'";
    $hod_query = mysqli_query($conn,$sql2);
    $hod=0;
    $pocet=0;
    $Nex_Row=false;
    while ($rov1 =$hod_query->fetch_assoc()){
        $hod = $hod+$rov1['Hodnoceni'];
        $pocet = $pocet+1;
    }
    if ($pocet==0){
        $vls=0.0;
    }
    else{
        $vls=round($hod/$pocet,1);
    }

    $count+=1;
    if ($count==1){
        echo '<div class="row g-3">';
    }

    echo( '

        <div class="produkt input-group-sm mb-3 col-md-4 ">
            <div class="top">

                <img class="image-produktu" title="'.$row["Nazev"].'" alt="'.$row["Nazev"].'" src="./images/'. $row['H_Obrazek'].'"/>
                <div>
                <div class="star-row">
                    <div class="hvezdy" title="Hodnocení '.$vls.'/5">
                        <div class="hvezdy-prazdne"></div>
                        <div class="pocet-hvezd" style="width:'.($vls*20).'%"></div>
                    </div>
                </div>
                </div>
                <h2 class="nazev-produktu">'.$row["Nazev"].'</h2>
                '.$row["Popis"].'
            </div>
            <div class="sopdek">
                <div class="cena">'.$row["Cena_Bez_DPH"].'</div>
                <div class="stranka"><a href="http://localhost/Obchod/produkt.php?ID_P='.$row["ID_P"].'"><button>aaa</button></a></div>
            </div>
        </div>
    '
    );
    if ($count==3){
        echo '</div>';
        $count=0;
    }

}


?>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="js/login.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>




</body>
<style>

    .input-group-text {
        cursor: pointer;
    }

    .fa-sign-out,
    .fa-eye,
    .fa-eye-slash {
        width: 1em;
        height: 1em;
    }

    .nav-item > span{
        cursor: pointer;
    }
</style>
</html>



