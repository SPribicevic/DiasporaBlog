<?php

    include('db_connect.php');

    if(!empty($_POST['param'])){
        $param = $_POST['param'];
        $country = $_POST['country'];

        if($param==='latest'){
            $query_select_latest_posts = "SELECT * FROM posts ORDER BY date_time DESC";
            $result = mysqli_query($mysqli,$query_select_latest_posts);
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
        }else{
            $query_select_latest_posts = "SELECT * FROM posts ORDER BY votes DESC";
            $result = mysqli_query($mysqli,$query_select_latest_posts);
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
        }
    }

    if(!empty($_POST['username'])){
        $username = $_POST['username'];
        $country = $_POST['country'];


            $query_select_latest_posts = "SELECT * FROM posts ORDER BY date_time DESC";
            $result = mysqli_query($mysqli,$query_select_latest_posts);
            if($result)
            while($row = mysqli_fetch_array($result)) {
                if ($row['country'] === $country && (strtolower($username)===strtolower($row['user']))) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $date_time = $row['date_time'];
                    $user = $row['user'];
                    $votes = $row['votes'];
                    echo '<div id="post">
                                <a href="post.php?id=' . $id . '">' . $title . '</a>
                                <p>Date: ' . $date_time . '</p>
                                <p>User: ' . $user . '</p>
                                <p>Votes: ' . $votes . '</p>
                            </div>';
                }
            }
    }

?>