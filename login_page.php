<?php
/**
 * Created by PhpStorm.
 * User: Paja
 * Date: 28.6.2015
 * Time: 12:54
 */

?>


<html>

<head>
    <title> Login </title>
    <link href="css/login.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">

    <div id="header">
        <h1>Hi, welcome to Dijaspora Dnevnici!</h1>
    </div>
    <div id="content">
        <div id="login">
            <form action="login.php" method="post">
                <fieldset>
                    <legend>Login</legend>
                    Email:<br>
                    <input name="email" type="text" id="email" size="30"/>
                    <br>
                    Password:<br>
                    <input name="password" type="password" id="password" size="30 "/>
                    <br>
                    <input name="submit" type="submit" value="Submit"/>
                    <br>
                </fieldset>
            </form>
        </div>

        <div id="register">
            <form action="register.php" method="post">
                <fieldset>
                    <legend>Register</legend>
                    First name:<br>
                    <input name="firstname" type="text" id="firstname" size="30"/>
                    <br>
                    Last name:<br>
                    <input name="lastname" type="text" id="lastname" size="30"/>
                    <br>
                    Email:<br>
                    <input name="email" type="text" id="email" size="30"/>
                    <br>
                    Password:<br>
                    <input name="password" type="password" id="password" size="30 "/>
                    <br>
                    Re-enter password:<br>
                    <input name="repassword" type="password" id="repassword" size="30 "/>
                    <br>
                    <input name="submit" type="submit" value="Submit"/>
                    <br>
                </fieldset>
            </form>
        </div>
    </div>

</div>
</body>

</html>

