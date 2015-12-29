<?php

include('post.class.php');
include('db_connect.php');
include('debug.php');

$arr = array();  // this are is going to be populated with data or errors

$validate = Post::validate($arr);

if($validate){
    /* data is ready for database insertion */


    $query_insert_post_data = "INSERT INTO posts(title,body,country,user,votes) VALUES('".$arr['title']."','".$arr['body']."','".$arr['country']."','".$arr['user']."','0')";
    mysqli_query($mysqli,$query_insert_post_data);

    $arr = array_map('stripslashes',$arr);
    $arr['date_time'] = date('r',time());

    $insert_post = new Post($arr);

    echo json_encode(array('status'=>1,'html'=>$insert_post->markup()));


}else{
    /* outputing error messages */

    echo '{"status":0,"errors":'.json_encode($arr).'}';
}

?>