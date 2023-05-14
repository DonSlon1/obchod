<?php
if ((!defined('MyConst'))) {
    if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
        header('Location: ../error/Method-Not-Allowed.php');
        exit;
    }
}
/**
 * zobrazí defaultí navigaci sjtejná na všech stránkách
 * @method navigace()
 * @param ?int $full
 * @return void
 * */
function navigace(?int $full = 1): void
{
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    echo('
<nav class="navbar navbar-expand-lg navbar-light bg-light h_nav" id="h_nav">
    <a class="navbar-brand My_Store" href="/">Obchod</a>
    ');
    if ($full == 1) {
        echo('
            <div class=" form_dov" id="search-nav">

                <form class="form-inline my-2 my-lg-0 w-100 search" autocomplete="off" id="search-form" method="get" action="/hledat.php">
                    <div class="search-div">
                        <input class=" search_bar" id="search" type="text" placeholder="Search" name="Nazev" >
                        <button class="  submit-button" type="submit">Hledat</button>
                       
                    </div>
                    <input class="reset-button" type="reset" value="X">
                </form>
                <div id="search-resoult">
                    <div id="predmet" >
                    
                    </div>
                    <div id="kategorie-hledani" >
                    
                    </div>
                    <div id="vyrobce-hledani" >
                    
                    </div>
                </div>
            </div>
            ');
    }
    echo('
        <div class="user_info">
            <div>
                <div class="h-fit w-fitcontent pr-3">
                    <a class="position-relative w-fitcontent " href="/basket.php" title="Košík">
                        <i class="basket_icon" ></i>
                        <span class="count" style="display: none;bottom: -8px !important;" id="count"></span>
                    </a>
                </div>
                
            </div>
            ');
    if (array_key_exists("logged_in", $_SESSION)) {
        echo('
                    <div class="position-relative">
                        <div class=" user open_div" id="user" >
                            <i class="icon_user"></i>
                            <i class="icon_check check_user"></i>
                        </div>
                        <div class="user_div" id="user_div">
                            <a href="/pomoc/logout.php" >Odhlásit</a>
                            <a href="/uzivatel/objednavka_uz.php" >Objednavky</a>
                            <a href="/uzivatel/recenze_uz.php" >Recenze</a>
                            <a href="/uzivatel/sprava-uctu.php" >Správa učtu</a>
                            ');
        if ($_SESSION["role"] == "Admin") {
            echo('<a href="/admin/admin" >Admin</a>');
        }
        echo('
                        
                            
                        </div>
                    </div>');


    } else {
        echo('
                    <div class="position-relative user" data-toggle="modal" data-target="#LoginModal">
                        <i class="icon_user"></i>
                    </div>
                    ');
    }

    echo('    </div>

</nav>
<div class="modal fade " id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <!--<div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Přihlášení</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>-->

            <div class="modal-body  mt-1 ml-4 mr-4 mb-1 login-modal">
                
                <div class="container ">
                    <div class="row " style="height: 100%">
                        


                            <!-- Nav tabs -->
                            

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div class="tab-pane active" id="login" role="tabpanel" aria-labelledby="login-tab" style="height: 100%">
                                    <form id="login-form" class="preventDefault" method="post" onsubmit="login()" ">
                                        <h1 id="prih_h1">Přihlášení</h1>
                                        <div id="ptih_h1_div" style="display: none">Spatny email nebo heslo</div>
                                        <input type="hidden" name="log_reg" value="login">
                                        <div class="form-group full-input">
                                            <input type="email" class="form-control " id="loginEmail" name="email"  maxlength="50" minlength="1" required>
                                            <label for="loginEmail">Email address</label>

                                        </div>

                                        <div class="form-group full-input">
                                            
                                            <div class="input-group mb-3">
                                                <input type="password" name="Password" class="form-control" style="z-index: auto " required id="loginPassword">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="show-password"><i class="icon-eye"></i></span>
                                                </div>
                                            </div>
                                            <label for="loginPassword">Password</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="login_keep_logged_in"  name="login_keep_logged_in">
                                            <label class="form-check-label" for="login_keep_logged_in">Keep me logged in</label>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block log-but" >Přihlásit se</button>
                                    </form>
                                </div>

                                <div class="tab-pane" id="register" role="tabpanel" aria-labelledby="register-tab">

                                    
                                </div>
                            
                        </div>
                    </div>
                </div>
                <div class="container ">
                    <div class="row row-login" >
                        <div >
                            <h2><span style="font-weight: 400;margin-bottom: 4px;">Nemáte ještě účet?</span>Registrujte se</h2>
                            <ul id="poup-login">
                                <li>
                                    <svg class="icon--ico-check" viewBox="0 0 32 32">

                                    </svg>Budete mít přehled o&nbsp;<strong>stavu své objednávky</strong>.
                                            </li>
                                            <li>
                                                <svg class="icon--ico-check" viewBox="0 0 32 32">

                                </svg>Za nasbírané body získáte <strong>slevy na další nákup</strong>.
                                            </li>
                                            <li>
                                                <svg class="icon--ico-check" viewBox="0 0 32 32">

                                </svg><strong>O&nbsp;akcích a&nbsp;soutěžích</strong> se dozvíte jako první.
                                </li>
                            </ul>
                            <a class="btn btn-primary btn-block registrace" href="/registrace.php" >Chci se zaregistrovat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
');
}
