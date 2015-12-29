<?php
/**
 * Created by PhpStorm.
 * User: Paja
 * Date: 28.6.2015
 * Time: 17:18
 */

session_start();
include('db_connect.php');

if(isset($_POST['submit'])){

    $test = true;

    if($_POST['firstname'] == ''){
        $_SESSION['error']['firstname'] = "First name is required";
        echo $_SESSION['error']['firstname'];
        $test = false;
    }

    if($_POST['lastname'] == ''){
        $_SESSION['error']['lastname'] = "Last name is required";
        echo $_SESSION['error']['lastname'];
        $test = false;
    }

    if($_POST['email'] == ''){
        $_SESSION['error']['email'] = "Email is required";
        echo $_SESSION['error']['email'];
        $test = false;
    }
    else {
        if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $_POST['email'])){
            $email= $_POST['email'];
            $sql1 = "SELECT * FROM users WHERE email = '$email'";
            $result1 = mysqli_query($mysqli,$sql1) or die();
            if (mysqli_num_rows($result1) > 0) {
                $_SESSION['error']['email'] = "This Email is already used.";
                echo $_SESSION['error']['email'];
                $test = false;
            }
        }
        else {
            $_SESSION['error']['email'] = "Your email is not valid.";
            echo $_SESSION['error']['email'];
            $test = false;
        }
    }

    if($_POST['password'] == ''){
        $_SESSION['error']['password'] = "Password is required";
        echo $_SESSION['error']['password'];
        $test = false;
    }

    if($_POST['password'] != $_POST['repassword']){
        $_SESSION['error']['password'] = "Passwords do not match";
        echo $_SESSION['error']['password'];
        $test = false;
    }

    if($test == true){
        $firstname = mysql_real_escape_string($_POST['firstname']);
        $lastname = mysql_real_escape_string($_POST['lastname']);
        $email = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);

        $password = md5($password);
        $hash = md5(rand(0,1000));

        $sql2 = "INSERT INTO users (first_name, last_name, email, password,confirmation)
        VALUES ('$firstname','$lastname','$email','$password','$hash')";

        $id = $mysqli->insert_id;
        $user = $firstname.' '.$lastname;

        $_SESSION['id'] = $id;
        $_SESSION['user'] = $user;

        $result2 = mysqli_query($mysqli,$sql2) or die("Error");

        $to = $email;
        $subject = 'Signup | Verification';
        $message = '

                Thanks for signing up!
                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

                ------------------------
                Username: '.$user.'
                Password: '.$password.'
                ------------------------

                Please click this link to activate your account:
                http://www.dijasporadnevnici.com/verify.php?email='.$email.'&hash='.$hash.'

        ';

        $headers = 'From:noreply@dijasporadnevnici.com' . '\r\n';

        mail($to,$subject,$message,$headers);

        header("Location: index.php");
    }

}

?>