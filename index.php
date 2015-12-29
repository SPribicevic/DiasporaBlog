<?php

    include('db_connect.php');

   // session_name('login');

    //session_set_cookie_params(2*7*24*60*60);

    session_start();

  /*  if(isset($_SESSION['id']) && !isset($_COOKIE['remember'])){
        $_SESSION = array();
        session_destroy();
    }*/

    if(isset($_GET['logoff'])){
        $_SESSION = array();
        $_SESSION['id'] = 'guest';
        header("Location: index.php");
        exit;
    }

    if(!isset($_SESSION['id']))
        $_SESSION['id'] = 'guest';

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dnevnici iz dijaspore</title>
<meta name="author" content="Stefan Prbicevic">

    <link rel="icon" type="image/png" href="images/logo.gif">

<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/fonts.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/map.css" rel="stylesheet" type="text/css" />

<script src="/A2EB891D63C8/avg_ls_dom.js" type="text/javascript"></script>
<script src="js/RequestAnimationFrame.js"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
<script src="js/raphael.js" type="text/javascript"></script>
<script src="js/raphaelAnimateViewBox.js" type="text/javascript"></script>
<script src="js/scale.raphael.js" type="text/javascript"></script>
<script src="js/paths.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript"></script>
    <link href="css/country.css" rel="stylesheet" type="text/css" />

</head>

<body>


    <div >
        <ul id="main_navigator">
            <li class="main_navigator"><img src="images/logo.gif" alt="LOGO" style="width:27px; height: 27px;"></li>
            <li class="main_navigator"><a class="active" href="index.php">Home</a></li>
            <li class="main_navigator"><a href="#about">About</a></li>
            <?php
                if($_SESSION['id'] === 'guest'){
                    echo '<li id="log" class="main_navigator"><a href="login_page.php">Log in / Sign up</a></li>';
                } else {
                    echo '<li id="log" class="main_navigator"><a href="index.php?logoff=1">Sign out</a></li>';
                    echo '<li id="log" class="main_navigator"><a href="">'.$_SESSION['user'].'</a></li>';
                }
            ?>

        </ul>
    </div>

    <div id="container">
    
        <div class="mapWrapper">
   
                <div id="map"></div>

                <div id="text"></div>
                

                     
        </div>


        
    </div>
    

</body>
</html>
