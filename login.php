<?php
/**
 * Created by PhpStorm.
 * User: Paja
 * Date: 28.6.2015
 * Time: 19:20
 */

session_start();
include("db_connect.php");
if(isset($_POST['submit'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password = md5($password);

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($mysqli,$query) or die();
    $num_row = mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);

    if( $num_row == 1 && $row['confirmation'] === '1') {
        $_SESSION['id'] = $row['id'];
        $_SESSION['user'] = $row['first_name'].' '.$row['last_name'];
        setcookie('remember','');
        header("Location: index.php");
        exit;
    }
    else {
        echo 'false';
    }
}

?>