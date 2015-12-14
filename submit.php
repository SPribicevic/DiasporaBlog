<?php

    include('comment.class.php');
    include('db_connect.php');
    include('debug.php');

    $arr = array();  // this are is going to be populated with data or errors

    $validate = Comment::validate($arr);

    if($validate){
        /* data is ready for database insertion */


        $query_insert_comment_data = "INSERT INTO comments(creator,text) VALUES('".$arr['name']."','".$arr['body']."')";
        mysqli_query($mysqli,$query_insert_comment_data);

        $arr = array_map('stripslashes',$arr);
        $arr['date_time'] = date('r',time());

        $insert_comment = new Comment($arr);

        echo json_encode(array('status'=>1,'html'=>$insert_comment->markup()));

    }else{
        /* outputing error messages */

        echo '{"status":0,"errors":'.json_encode($arr).'}';
    }

?>