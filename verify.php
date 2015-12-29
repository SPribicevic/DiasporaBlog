<html>
<head>
    <title>DijasporaDnevnici > Sign up</title>
    <link href="css/verify.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <!-- start header div -->
    <div id="header">
        <h3>DijasporaDnevnici > Sign up</h3>
    </div>
    <!-- end header div -->

    <!-- start wrap div -->
    <div id="wrap">
        <!-- start PHP code -->
        <?php

            include('db_connect.php');
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                // Verify data
                $email = mysql_real_escape_string($_GET['email']); // Set email variable
                $confirmation = mysql_real_escape_string($_GET['confirmation']); // Set hash variable

                $search = mysql_query("SELECT email, confirmation FROM users WHERE email='".$email."' AND confirmation='".$confirmation."'") or die(mysql_error());
                $match  = mysql_num_rows($search);

                if($match > 0){
                    // We have a match, activate the account
                    mysql_query("UPDATE users SET confirmation='1' WHERE email='".$email."' AND confirmation='".$confirmation."'") or die(mysql_error());
                    echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
                }else{
                    // No match -> invalid url or account has already been activated.
                    echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
                }

            }else{
                // Invalid approach
                echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
            }

        ?>
<!-- stop PHP Code -->


</div>
<!-- end wrap div -->
</body>
</html>
