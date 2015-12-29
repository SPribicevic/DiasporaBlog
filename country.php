<?php
include('db_connect.php');
session_start();

$country = $_GET['country'];
$user = $_SESSION['user'];



?>

<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $country; ?></title>
        <meta name="author" content="Stefan Prbicevic">
        <link rel="icon" type="image/png" href="images/logo.gif">
        <link href="css/country.css" rel="stylesheet" type="text/css">
        <link href="css/reset.css" rel="stylesheet" type="text/css" />
        <link href="css/fonts.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/map.css" rel="stylesheet" type="text/css" />
        <link href="css/addPost.css" rel="stylesheet" type="text/css" />

        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/addPost.js" type="text/javascript"></script>
        <script src="js/newPost.js" type="text/javascript"></script>
        <script src="js/orderPosts.js" type="text/javascript"></script>

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
            <?php

                if($_SESSION['id'] !== 'guest'){
                    echo '
                            <div id="addPostContainer">
                            <p>Add a Post</p>
                            <form id="addPostForm" method="post" action="">
                                <div>
                                    <label for="title">Post Title</label>
                                    <input type="text" id="title" name="title"/>

                                    <label for="body">Post Body</label>
                                    <textarea name="body" id="body" cols="20" rows="5"></textarea>

                                    <input type="hidden" name="country" id="country" value="'.$country.'" />
                                    <input type="hidden" name="user" id="user" value="'.$user.'" />

                                    <input type="submit" id="submit" value="Submit" />
                                </div>
                            </form>
                        </div>
                        ';
                   /* echo'
                            <input id="newPostBtn" type="button" value="NEW POST" onclick="newPost()" />
                            <div id="newPost"></div>
                    ';*/
                }

            ?>
            <div id="menu">
                <ul id="secondary_navigator">
                    <li class="secondary_navigator"> <input type="button" value="Latest" onclick="orderBy('latest','<?php echo $country;?>')" /> </li>
                    <li class="secondary_navigator"> <input type="button" value="Votes" onclick="orderBy('votes','<?php echo $country;?>')" /> </li>

                    <li class="secondary_navigator_right"> <input type="button" value="Filter by Username" onclick="filterPostsWithUsername('<?php echo $country;?>')" /> </li>
                    <li class="secondary_navigator_right"> <input type="text" id="user_filter" /> </li>
                </ul>
            </div>
            <div id="blogSpace">
                <?php
                    $query_posts_for_country = "SELECT * FROM posts ORDER BY date_time DESC";
                    $result = mysqli_query($mysqli,$query_posts_for_country) or die();
                    while($row = mysqli_fetch_array($result)){
                        if($row['country']===$country) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $date_time = $row['date_time'];
                            $user = $row['user'];
                            $votes = $row['votes'];
                            echo '<div id="post">
                                <a href="post.php?id=' . $id . '">' . $title . '</a>
                                <p>Date: ' . $date_time . '</p>
                                <p>User: ' . $user . '</p>
                                <p>Votes: '. $votes .'</p>
                            </div>';
                        }
                    }
                ?>
            </div>
        </div>


    </body>

</html>