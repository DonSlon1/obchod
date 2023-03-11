<?php
    /**
     * zobrazí defaultí navigaci sjtejná na všech stránkách
     * @method navigace()
     * @param int $full
     * @return void
     * */
    function navigace(?int $full = 1) : void
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        echo('
<nav class="navbar navbar-expand-lg navbar-light bg-light h_nav">
    <a class="navbar-brand My_Store" href="obchod">My Store</a>
    <div class="nav_div">');
        if ($full == 1) {
            echo('
            <div class="mr-4 form_dov">

                <form class="form-inline my-2 my-lg-0 w-100">
                    <input class="form-control mr-sm-2 search_bar" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            
            </div>
            ');
        }
        echo('
            <div class="h-fit">
                <a class="position-relative " href="basket.php">
                    <i class="fas fa-shopping-basket green_icon basket_icon" ></i>
                    <span class="count" style="display: none" id="count"></span>
                </a>
            </div>
            <ul class="navbar-nav pr-2">');

        if (array_key_exists("logged_in", $_COOKIE)) {
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
                        <span class="nav-link" data-toggle="modal" data-target="#LoginModal">Login</span>                      
                    </li>
        ');
        }


        echo('    </ul></div>

</nav>
<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel" aria-hidden="true">
    <div class="modal-dialog w-fitcontent" role="document">
        <div class="modal-content w-fitcontent">
            <!--<div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Shop Login/Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>-->
            <ul class="nav nav-tabs " id="LoginTab" role="tablist">
                    <li class="nav-item w-100" >
                        <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" 
                            role="tab" aria-controls="login" aria-selected="true" style="border-top-right-radius: 0 !important;">
                            Login
                        </a>
                    </li>
                    <li class="nav-item w-100" >
                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" 
                            role="tab" aria-controls="register" aria-selected="false" style="border-top-left-radius: 0 !important;">
                            Register
                        </a>
                    </li>
            </ul>
            <div class="modal-body w-fitcontent mt-1 ml-4 mr-4 mb-1">
                
                <div class="container  w-fitcontent">
                    <div class="row w-fitcontent">
                        <div >


                            <!-- Nav tabs -->
                            

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div class="tab-pane active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                    <form id="login-form" class="preventDefault" method="post" onsubmit="login()">
                                        <input type="hidden" name="log_reg" value="login">
                                        <div class="form-group">
                                            <label for="loginEmail">Email address</label>
                                            <input type="email" class="form-control" id="loginEmail" name="email" aria-describedby="emailHelp">
                                            <small id="emailHelpLogin" class="form-text text-muted">We will never share your email with anyone else.</small>
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

                                <div class="tab-pane" id="register" role="tabpanel" aria-labelledby="register-tab">');
        //! preventDefault nemazat zajisti aby se formulář neodeslal

        echo('
                                    <form id="reg-form" class="preventDefault" method="post" onsubmit="registration()">
                                        <input type="hidden" name="log_reg" value="registration">
                                        <div class="form-group">
                                            <label for="registerEmail">Email address</label>
                                            <input type="email" class="form-control" name="email" id="registerEmail" aria-describedby="emailHelp">
                                            <small id="emailHelp" class="form-text text-muted">We wil never share your email with anyone else.</small>
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
                                            <label for="Mesto">Mesto</label>
                                            <input type="text" class="form-control" id="Mesto" name="Mesto" aria-describedby="emailHelp">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="Ulice">Ulice</label>
                                            <input type="text" class="form-control" id="Ulice" name="Ulice" aria-describedby="emailHelp">
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
');
    }
