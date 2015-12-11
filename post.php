<?php
    include('db_connect.php');
    include('comment.class.php');
    $id = $_GET['id'];
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
    <link href="css/country.css" rel="stylesheet" type="text/css">

</head>

<body>

<div >
    <ul id="main_navigator">
        <li class="main_navigator"><a class="active" href="index.php">Home</a></li>
        <li class="main_navigator"><a href="#about">About</a></li>
    </ul>
</div>

    <div id="container">

        <div id="comment">
            <?php
            $query_posts = "SELECT * FROM posts";
            $result = mysqli_query($mysqli,$query_posts) or die();
            while($row = mysqli_fetch_array($result)){
                if($row['id']==$id) {
                    $title = $row['title'];
                    $date_time = $row['date_time'];
                    $user = $row['user'];
                    $rating = $row['rating'];
                    $text = $row['text'];
                }
            }
            ?>

            <div id="title">
                <?php echo $title."<br>"; echo $text;?>
            </div>

            <div id="addCommentContainer">
                <p>Add a Comment</p>
                <form id="addCommentForm" method="post" action="">
                    <div>
                        <label for="name">Your Name</label>
                        <input type="text" name="name" id="name" />

                        <label for="email">Your Email</label>
                        <input type="text" name="email" id="email" />

                        <label for="url">Website (not required)</label>
                        <input type="text" name="url" id="url" />

                        <label for="body">Comment Body</label>
                        <textarea name="body" id="body" cols="20" rows="5"></textarea>

                        <input type="submit" id="submit" value="Submit" />
                    </div>
                </form>
            </div>

            <?php
            /* Select all comments and populate array $comments with objects  */

            $comments = array();
            $request_comments = "SELECT * FROM comments WHERE id_post='$id'";
            $result = mysqli_query($mysqli,$request_comments) or die();
            while($row = mysqli_fetch_array($result)){
                $comments[] = new Comment($row);
            }

            /* Output the comments one by one */

            foreach($comments as $c){
                echo $c->markup();
            }

            ?>

        </div>


    </div>




</body>
</html>