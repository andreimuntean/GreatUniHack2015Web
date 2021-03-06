<?php
session_start();
if(isset($_SESSION["email"]))
{
    header("Location: dashboard.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WebSite</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" href="css/login.css" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">hI-Dare</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">How it works</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#donations">Donations</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#charity">List of charities</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Dare someone</h1>
                <hr>
                <p>Dare a friend to do a weird thing and donate to a charity instead.<br>#dare #donate #haveFun #help</p>
                <a href="#" class="btn btn-primary btn-xl page-scroll" role="button" data-toggle="modal" data-target="#login-modal">Login | Register</a>
            </div>
        </div>
    </header>


<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header" align="center">
        <img class="img-circle" id="img_logo" src="img/logo.png">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        </button>
    </div>
    
    <!-- Begin # DIV Form -->
    <div id="div-forms">
    
        <!-- Begin # Login Form -->
        <form id="login-form">
            <div class="modal-body">
                <div id="div-login-msg">
                    <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                    <span id="text-login-msg">Type your email and password.</span>
                </div>
                <input id="login_email" class="form-control" type="email" placeholder="Email" required>
                <input id="login_password" class="form-control" type="password" placeholder="Password" required>
                <div class="checkbox">
                    <label>
                        <input type="checkbox">Remember me
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                </div>
                <div>
                    <button id="login_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                    <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                </div>
            </div>
        </form>
        <!-- End # Login Form -->
        
        <!-- Begin | Lost Password Form -->
        <form id="lost-form" style="display:none;">
            <div class="modal-body">
                <div id="div-lost-msg">
                    <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                    <span id="text-lost-msg">Type your e-mail.</span>
                </div>
                <input id="lost_email" class="form-control" type="text" placeholder="E-Mail" required>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
                </div>
                <div>
                    <button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
                    <button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
                </div>
            </div>
        </form>
        <!-- End | Lost Password Form -->
        
        <!-- Begin | Register Form -->
        <form id="register-form" style="display:none;">
            <div class="modal-body">
                <div id="div-register-msg">
                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                    <span id="text-register-msg">Register an account.</span>
                </div>
                <input id="register_email" class="form-control" type="text" placeholder="E-Mail" required>
                <input id="register_password" class="form-control" type="password" placeholder="Password" required>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                </div>
                <div>
                    <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                    <button id="register_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                </div>
            </div>
        </form>
        <!-- End | Register Form -->
        
    </div>
    <!-- End # DIV Form -->
    
</div>
</div>
</div>
<!-- END # MODAL LOGIN -->


    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">How it works</h2>
                    <hr class="light">
                    <p class="text-faded">You challenge someone to fulfill a task. If they succeed you donate to a charity. You both have fun and help an NGO at the same time.</p>
                    <a href="#" class="btn btn-default btn-xl">Get Started!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="donations">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Donations</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                        <h3>1. Challenger issues dare</h3>
                        <p class="text-muted">Choose a challenge and send it to a friend.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>2. Challengee accepts/rejects</h3>
                        <p class="text-muted">The person takes the challenge or rejects it.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>3. Challengee sends proof of completing the challenge</h3>
                        <p class="text-muted">You confirm whether the challenge was completed or not.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Challenger makes promised donation to challengee's chosen charity</h3>
                        <p class="text-muted">Donate to the charity.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="no-padding" id="charity">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/charities/1.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Charity Category
                                </div>
                                <div class="project-name">
                                    Charity Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/charities/2.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Charity Category
                                </div>
                                <div class="project-name">
                                    Charity Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/charities/3.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Charity Category
                                </div>
                                <div class="project-name">
                                    Charity Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/charities/4.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Charity Category
                                </div>
                                <div class="project-name">
                                    Charity Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/charities/5.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Charity Category
                                </div>
                                <div class="project-name">
                                    Charity Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/charities/6.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Charity Category
                                </div>
                                <div class="project-name">
                                    Charity Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section>
        
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:your-email@your-domain.com">email@domain.com</a></p>
            </div>
        </div>
    </aside>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>
    <script src="js/login.js"></script>

</body>

</html>
