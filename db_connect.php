<?php

    /* db conf */

    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $db = 'dijaspora_blog';

    /* end conf */

    $mysqli = mysqli_connect($host,$user,$pass,$db) or die('Database error');
?>