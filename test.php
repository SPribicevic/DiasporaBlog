<?php

    include('db_connect.php');



    $array1 = [1 => 'foo',
                    2 => 'bar'];
    $array2 = [3 => 'blob'];

    foreach($array1 as $k=>$v){
        $array2[$k] = $v;
    }

    var_dump($array2);

    $query_insert_comment_data = "INSERT INTO comments(creator,text,post_id) VALUES('1','2',1)";
    $error = mysqli_query($mysqli,$query_insert_comment_data);


?>

<html>

<head>
    <link href="css/comment2.css" rel="stylesheet" type="text/css"/>
</head>

<body>

    <div class="comment">
        <div id="name">Test</div>
        <div class="date" title="Added at '.
                        date('H:i \o\n d M Y',$d['date_time']).'">16.7.1994.</div>
        <p>Tekst komentara</p>
    </div>

</body>

</html>