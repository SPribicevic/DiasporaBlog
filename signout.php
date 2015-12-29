<?php
/**
 * Created by PhpStorm.
 * User: Paja
 * Date: 29.6.2015
 * Time: 19:11
 */

session_start();
unset($_SESSION['id']);
unset($_SESSION['user']);
header('Location: index.php');

?>