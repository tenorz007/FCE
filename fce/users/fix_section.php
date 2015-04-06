<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

if (isset($_POST['submit'])) {
    $mysqli->query("UPDATE sections_interface SET $_POST[error_column] = '$_POST[new_value]' WHERE crn='$_GET[crn]'");
    header("Location: process_sections.php");
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Fix Section</title>
<!-- Favicon Kini -->
        <link rel="apple-touch-icon" sizes="57x57" href="../images/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../images/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../images/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../images/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../images/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../images/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../images/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../images/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../images/favicons/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="../images/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="../images/favicons/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="../images/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="../images/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="../images/favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-TileImage" content="../images/favicons/mstile-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <!-- End of Favicon Kini -->
<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="../css/style.custom.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- start plugins -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<!--font-Awesome-->
    <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
<!--font-Awesome-->
</head>
<body>
<div class="header_bg1">
<div class="container">
    <div class="row header">
        <div class="logo navbar-left">
            <h1><a href="index.html">Faculty Course Evaluation</a></h1>
        </div>
        <div class="h_search navbar-right">
			<form action="../includes/logout.php" method="post">
				<button class='black-btn margin' name='logout' value='logout'>Logout</button>
			</form>
		</div>
    </div>
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
                    <li class='active'><a href="./admin.php"><img src="../images/back.png" alt="Back to Home" style="width:18px;height:18px"></a></li>
                    <?php
                    list_roles('');
                    $semester = getCurrentSemester();
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</div>
</div>
<div class="text-center">
    <br></br>
    <a href="./admin_add_user.php"><button class='black-btn'>Add User</button></a>
    <a href="./admin_add_section.php"><button class='black-btn'>Add Section</button></a>
    <a href="./admin_manage_user.php"><button class='black-btn'>Manage User</button></a>
</div>

<div class="main_bg"><!-- start main -->
    <div class="container">
        <div class="text-center">
            <br></br>
            <a href="./process_sections.php"><button class='black-btn'>Process Sections</button></a>
        </div><hr>
        <div class="main text-center row para"> 
            <div class="col-xs-4 text-center size-before"></div>        
            <div class="col-xs-4 text-center border size-panel">
                <form action="" method="post">
                    <?php
                    $crn = $_GET['crn'];
                    $result = $mysqli->query("SELECT error_column, error_message FROM sections_interface WHERE crn='$crn'")->fetch_assoc();
                    $result2 = $mysqli->query("SELECT $result[error_column] FROM sections_interface WHERE crn='$crn'")->fetch_array();
                    echo "<h4>Fix Section Details</h4><hr>";
                    echo "<label><span class='error'>Error Message</span></label><br>
                    <p>$result[error_message]</p><br>";
                    echo "<label>Previous <span class='error'>$result[error_column]</span></label><br>
                    <input type='text' value='$result2[0]' disabled><br><br>";
                    echo "<label>New <span class='error'>$result[error_column]</span></label><br>
                    <input type='text' name='new_value' value='$result2[0]' required><br><br>";
                    echo "<input type='hidden' name='error_column' value='$result[error_column]'>";
                    ?>
                    <button class="black-btn" name="submit">Fix Section</button>

                </form>
            </div>
        </div>
    </div>
</div>

<FOOTER>
        <div class="footer_bg"><!-- start footer -->
            <div class="container">
                <div class="row  footer">
                    <div class="copy text-center">
                        <p class="link"><span>&#169; All rights reserved | Design by&nbsp;<a href="../thankyou.php#fceteam"> The FCE Team</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </FOOTER>
</body>
</html>
