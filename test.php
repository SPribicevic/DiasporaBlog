<?php

    $array1 = [1 => 'foo',
                    2 => 'bar'];
    $array2 = [3 => 'blob'];

    foreach($array1 as $k=>$v){
        $array2[$k] = $v;
    }

    var_dump($array2);

?>