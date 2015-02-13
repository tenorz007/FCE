<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>FCE Login</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
       <![endif]-->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- start plugins -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <!-- start slider -->
        <link href="css/slider.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/style.custom.css" rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="js/modernizr.custom.28468.js"></script>
        <script type="text/javascript" src="js/jquery.cslider.js"></script>
        <script type="text/javascript">
            $(function() {

                $('#da-slider').cslider({
                    autoplay: true,
                    bgincrement: 450
                });

            });
        </script>
        <!-- Owl Carousel Assets -->
        <link href="css/owl.carousel.css" rel="stylesheet">
        <script src="js/owl.carousel.js"></script>
        <script>
    $(document).ready(function() {

        $("#owl-demo").owlCarousel({
            items: 4,
            lazyLoad: true,
            autoPlay: true,
            navigation: true,
            navigationText: ["", ""],
            rewindNav: false,
            scrollPerPage: false,
            pagination: false,
            paginationNumbers: false,
        });

    });
        </script>
        <!-- //Owl Carousel Assets -->
        <!--font-Awesome-->
        <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
        <!--font-Awesome-->
    </head>
    <body>
        <div class="header_bg">
            <div class="container">
                <div class="row header">
                    <div class="logo navbar-left">
                        <h1><a href="index.html">Faculty Course Evaluation</a></h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row h_menu">
                <nav class="navbar navbar-default navbar-left" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                        </ul>
                    </div><!-- /.navbar-collapse -->
                    <!-- start soc_icons -->
                </nav>
            </div>
        </div>
        <div class="container" style="margin-top: 30px">
            <?php
            if (isset($_SESSION['err'])) {
                $err = $_SESSION['err'];
                echo '<div class="main row">
                <div class="col-xs-3 bg1 text-center"></div>';
                echo "<div class='error errorborder col-xs-6 text-center'><h4>Error! $err</h4></div>";
                echo '<div class="col-xs-3 bg1 text-center"></div></div>';

                unset($_SESSION['err']); // Destroys the err session variable
            }
            ?>
            <div class="main row">
                <div class="col-md-6 images_1_of_4 bg1 text-center"></div>		
                <div class="col-md-3 images_1_of_4 bg1 text-center border">
                    <form method="post" name="" class="para" action="includes/evaluate.php">
                        <input type="text" name='key_value' placeholder=" Access Key" class="round" required pattern=".{5,5}" title="Exactly 5 characters" maxlength='5'><br>
                        <br><br><br>
                        <button class="fa-btn btn-1 btn-1e">EVALUATE</button>
                    </form>
                </div>
                <div class="col-md-6 images_1_of_4 bg1 text-center"></div>	
                <div class="col-md-3 images_1_of_4 bg1 text-center border">
                    <form method="post" action="includes/login.php" class="para">
                        <input type="text" name="email" placeholder=" Email" class="round"><BR><BR>
                        <input type="password" name="password" placeholder=" Password" class="round">
                        <p></p>
                        <button class="fa-btn btn-1 btn-1e">LOG IN</button>
                    </form>
                </div>	
                <div class="col-md-6 images_1_of_4 bg1 text-center"></div>	
            </div>
        </div>

    <FOOTER>
        <div class="footer_bg"><!-- start footer -->
            <div class="container">
                <div class="row  footer">
                    <div class="copy text-center">
                        <p class="link"><span>&#169; All rights reserved | Design by&nbsp;<a href="#"> The FCE Team</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </FOOTER>
</body>
</html>