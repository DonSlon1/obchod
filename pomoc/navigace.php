<?php
    /**
     * zobrazí defaultí navigaci sjtejná na všech stránkách
     * @method navigace()
     * @param ?int $full
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
    ');
        if ($full == 1) {
            echo('
            <div class=" form_dov">

                <form class="form-inline my-2 my-lg-0 w-100">
                    <input class="form-control mr-sm-2 search_bar" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            
            </div>
            ');
        }
        echo('
        <div class="user_info">
            <div>
                <div class="h-fit w-fitcontent pr-3">
                    <a class="position-relative w-fitcontent " href="basket.php">
                        <i class="basket_icon" ></i>
                        <span class="count" style="display: none;bottom: -8px !important;" id="count"></span>
                    </a>
                </div>
                
            </div>
            ');
        if (array_key_exists("logged_in", $_COOKIE)) {
            echo('
                    <div class="position-relative">
                        <div class=" user open_div" id="user" >
                            <i class="icon_user"></i>
                            <i class="icon_check check_user"></i>
                        </div>
                        <div class="user_div" id="user_div">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti eius fugit quis repellat. Aliquam aperiam architecto, doloremque earum iste iure laboriosam magni natus nesciunt quas quidem ratione veniam vitae voluptate.
                        </div>
                    </div>

                    ');
        } else {
            echo('
                    <div class="position-relative user" data-toggle="modal" data-target="#LoginModal">
                        <i class="icon_user"></i>
                    </div>
                    ');
        }

        echo('    </div>

</nav>
<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
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
            <div class="modal-body  mt-1 ml-4 mr-4 mb-1 login-modal">
                
                <div class="container ">
                    <div class="row ">
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
                                                    <span class="input-group-text" id="show-password"><i class="icon-eye"></i></span>
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
