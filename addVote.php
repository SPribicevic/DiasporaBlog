<?php
    include('db_connect.php');
    if(!empty($_POST['id'])){
        $post_id = $_POST['id'];
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $vote_rank = $_POST['vote_rank'];

        // inserting new row in ip_address_vote_map
        $query_insert_vote_rank = "INSERT INTO ip_address_vote_map (post_id,ip_address,vote_rank)
                                    VALUES ('" . $post_id ."','" . $ip_address ."','" . $vote_rank ."')";
        mysqli_query($mysqli,$query_insert_vote_rank);

        // updating votes value in posts
        switch($vote_rank){
            case "1":
                $update_votes = "UPDATE posts SET votes = votes+1 WHERE id='" . $post_id ."'";
                break;
            case "-1":
                $update_votes = "UPDATE posts SET votes = votes-1 WHERE id='" . $post_id ."'";
                break;
        }
        mysqli_query($mysqli,$update_votes);

        // get the sum of all vote_ranks for this post and ip_address
        $query_sum_vote_ranks = "SELECT SUM(vote_rank) as vote_rank FROM ip_address_vote_map WHERE post_id='" . $post_id ."' AND ip_address='" . $ip_address ."'";
        $result = mysqli_query($mysqli,$query_sum_vote_ranks);
        while($row = mysqli_fetch_assoc($result)){
            $vote_status = $row['vote_rank'];
        }
        print $vote_status;
    }

?>