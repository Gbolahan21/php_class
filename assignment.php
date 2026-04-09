<?php
    // Assignment one
    // $variable_1 = "My name is";
    // $variable_2 = "Sodiq";
    // $variable_3 = "Mohammed,";
    // $variable_4 = "a student of class'27";
    // $variable_5 = "Cybersecurity Student";
    // $variable_6 = "I am a:";
    // $variable_7 = "Frontend developer,";
    // $variable_8 = "Learning backend, and also";
    // $variable_9 = "PHP (Hypertext Preprocessor) as the programming language, and this is my";
    // $variable_10 = "first class";

    // // space function
    // echo $variable_1;
    // echo " ";
    // echo $variable_2;
    // echo " ";
    // echo $variable_3;
    // echo " ";
    // echo $variable_4;
    // echo " ";
    // echo $variable_5;

    // // breaking (br) funtion
    // echo "<br>";
    // echo $variable_6;
    // echo "<br>";
    // echo $variable_7;
    // echo "<br>";
    // echo $variable_8;
    // echo "<br>";
    // echo $variable_9;

    // // adding space function and replace function together
    // echo " ";
    // echo str_replace("class", "assignment", $variable_10)

    // Assignment two
    // count() function
    $arr = [1, 2, 3];
    echo count($arr);

    // array_push()
    $arr = [1, 2];
    array_push($arr, 3, 4);
    print_r($arr);

    // array_pop
    $arr = [1, 2, 3];
    array_pop($arr);
    print_r($arr); 

    // array_shift()
    $arr = [1, 2, 3];
    array_shift($arr);
    print_r($arr);

    // array_unshift()
    $arr = [2, 3];
    array_unshift($arr, 1);
    print_r($arr);

    // in_array()
    $arr = ["apple", "banana"];
    var_dump(in_array("apple", $arr));

    // array_key_exists()
    $arr = ["name" => "John"];
    var_dump(array_key_exists("name", $arr));

    // array_keys()
    $arr = ["a" => 1, "b" => 2];
    print_r(array_keys($arr));

    // array_values()
    $arr = ["a" => 1, "b" => 2];
    print_r(array_values($arr));

    // array_merge()
    $a = [1, 2];
    $b = [3, 4];
    print_r(array_merge($a, $b));

    // array_slice()
    $arr = [1, 2, 3, 4];
    print_r(array_slice($arr, 1, 2));

    // array_splice()   
    $arr = [1, 2, 3, 4];
    array_splice($arr, 1, 2);
    print_r($arr);

    // array_search()
    $arr = ["a" => "apple", "b" => "banana"];
    echo array_search("banana", $arr);

    // array_unique()
    $arr = [1, 2, 2, 3];
    print_r(array_unique($arr));

    // sort()
    $arr = [3, 1, 2];
    sort($arr);
    print_r($arr);

    // rsort()
    $arr = [1, 2, 3];
    rsort($arr);
    print_r($arr);

    // asort()
    $arr = ["b" => 2, "a" => 1];
    asort($arr);
    print_r($arr);

    // ksort()
    $arr = ["b" => 2, "a" => 1];
    ksort($arr);
    print_r($arr);

    // array_reverse()
    $arr = [1, 2, 3];
    print_r(array_reverse($arr));

    // array_map()
    $arr = [1, 2, 3];
    $result = array_map(function($x) {
        return $x * 2;
    }, $arr);

    print_r($result);
?>
