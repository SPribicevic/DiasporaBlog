<?php
include('db_connect.php');
$country = $_GET['country'];

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

    </head>

    <body>

        <div >
            <ul id="main_navigator">
                <li class="main_navigator"><a class="active" href="index.php">Home</a></li>
                <li class="main_navigator"><a href="#about">About</a></li>
            </ul>
        </div>

        <div id="container">
            <div id="menu">
                <ul id="secondary_navigator">
                    <li class="secondary_navigator"><a class="active" href="index.php">Latest</a></li>
                    <li class="secondary_navigator"><a href="#about">User</a></li>
                    <li class="secondary_navigator"><a href="#about">Rating</a></li>
                </ul>
            </div>
            <div id="blog_space">
                <?php
                    $query_posts_for_country = "SELECT * FROM posts";
                    $result = mysqli_query($mysqli,$query_posts_for_country) or die();
                    while($row = mysqli_fetch_array($result)){
                        if($row['country']===$country) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $date_time = $row['date_time'];
                            $user = $row['user'];
                            $rating = $row['rating'];
                            echo '<div id="post">
                                <a href="post.php?id=' . $id . '">' . $title . '</a>
                                <p>Date: ' . $date_time . '</p>
                                <p>User: ' . $user . '</p>
                            </div>';
                        }
                    }
                ?>
            </div>
        </div>


    </body>

</html>