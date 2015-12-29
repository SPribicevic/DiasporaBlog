<?php
    include('db_connect.php');
    include('comment.class.php');
    include('debug.php');
    $id = $_GET['id'];


    session_start();

    $user = $_SESSION['user'];

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
    <link href="css/country.css" rel="stylesheet" type="text/css"/>
    <link href="css/comment.css" rel="stylesheet" type="text/css"/>
    <link href="css/post.css" rel="stylesheet" type="text/css" />


    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/post.js" type="text/javascript"></script>
    <script src="js/vote.js" type="text/javascript"></script>


</head>

<body>

<div >
    <ul id="main_navigator">        <!--site's main menu-->
        <li class="main_navigator"><img src="images/logo.gif" alt="LOGO" style="width:27px; height: 27px;"></li>
        <li class="main_navigator"><a class="active" href="index.php">Home</a></li>
        <li class="main_navigator"><a href="#about">About</a></li>
        <?php
        // if guest then show login button, else show logoff and profile btn
        if($_SESSION['id'] === 'guest'){
            echo '<li id="log" class="main_navigator"><a href="login_page.php">Log in / Sign up</a></li>';
        } else {
            echo '<li id="log" class="main_navigator"><a href="index.php?logoff=1">Sign out</a></li>';
            echo '<li id="log" class="main_navigator"><a href="">'.$_SESSION['user'].'</a></li>';
        }
        ?>
    </ul>
</div>


    <div id="post_container">

        <div id="post">
            <?php
            //    find post by ID
            $query_posts = "SELECT * FROM posts";
            $result = mysqli_query($mysqli,$query_posts) or die();
            while($row = mysqli_fetch_array($result)){
                if($row['id'] == $id) {
                    $title = $row['title'];
                    $date_time = $row['date_time'];
                    $user = $row['user'];
                    $votes = $row['votes'];
                    $body = $row['body'];
                }
            }

            //  find data for voting from this IP addr for this post
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $vote_rank = 0;     // voted value from this IP addr ( default 0 )
            // markers for turning btns on/off
            $up = '';
            $down = '';

            $query_get_all_vote_ranks = "SELECT SUM(vote_rank) as vote_rank FROM ip_address_vote_map WHERE post_id='" . $id . "' and ip_address='" . $ip_address . "'";
            if($result = mysqli_query($mysqli,$query_get_all_vote_ranks)){
                while($row = mysqli_fetch_assoc($result)){
                    $vote_rank = $row['vote_rank'];
                    // already downvoted
                    if($vote_rank == -1){
                        $up = 'enabled';
                        $down = 'disabled';
                    }elseif($vote_rank == 1){
                        $up = 'disabled';
                        $down = 'enabled';
                    }
                }
            }




            ?>

            <input type="hidden" id="votes-<?php echo $id; ?>" value="<?php echo $votes; ?>">   <!--// current number of votes-->

            <div class="btn-votes" id="">     <!-- // Vote buttons, onclick call function addVote(), which is defined in ajax script above-->

                <input type="button" title="Up" class="up" onClick="addVote(<?php echo $id; ?>,'1')" <?php echo $up; ?> />  <!--// upvote button-->

                <div class="label-votes"><?php echo $votes; ?></div> <!--// link's rating at the monent-->

                <input type="button" title="Down" class="down" onClick="addVote(<?php echo $id; ?>,'-1')" <?php echo $down; ?> />  <!--// downvote button-->

            </div>



        </div>

        <div id="addCommentContainer">
            <p>Add a Comment</p>
            <form id="addCommentForm" method="post" action="">
                <div>
                    <?php if($_SESSION['id'] === 'guest') {
                    echo'
                    <label for="name">Your Name</label>
                    <input type="text" name="name" id="name" />
                    ';}else{
                        echo'
                             <input type="hidden" name="name" id="name" value="'.$user.'" />
                        ';
                    } ?>

                    <label for="body">Comment Body</label>
                    <textarea name="body" id="body" cols="20" rows="5"></textarea>

                    <input type="hidden" name="post_id" id="post_id" value="<?php echo $id;?>" />

                    <input type="submit" id="submit" value="Submit" />
                </div>
            </form>
        </div>


        <?php
        /* Select all comments and populate array $comments with objects  */

        $comments = [];
        $request_comments = "SELECT * FROM comments WHERE post_id='$id'";
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



</body>
</html>