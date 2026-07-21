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
    // Returns the number of elements in an array
    // $arr = [1, 2, 3];
    // echo count($arr);

    // // array_push()
    // // Adds one or more elements to the end
    // $arr = [1, 2];
    // array_push($arr, 3, 4);
    // print_r($arr);

    // // array_pop
    // // Removes the last element
    // $arr = [1, 2, 3];
    // array_pop($arr);
    // print_r($arr); 

    // // array_shift()
    // // Removes the first element
    // $arr = [1, 2, 3];
    // array_shift($arr);
    // print_r($arr);

    // // array_unshift()
    // // Adds elements to the beginning
    // $arr = [2, 3];
    // array_unshift($arr, 1);
    // print_r($arr);

    // // in_array()
    // // Checks if a value exists
    // $arr = ["apple", "banana"];
    // var_dump(in_array("apple", $arr));

    // // array_key_exists()
    // // To Checks if a key exists
    // $arr = ["name" => "John"];
    // var_dump(array_key_exists("name", $arr));

    // // array_keys()
    // // To Returns all keys
    // $arr = ["a" => 1, "b" => 2];
    // print_r(array_keys($arr));

    // // array_values()
    // // To Returns all values
    // $arr = ["a" => 1, "b" => 2];
    // print_r(array_values($arr));

    // // array_merge()
    // // Merges arrays
    // $a = [1, 2];
    // $b = [3, 4];
    // print_r(array_merge($a, $b));

    // // array_slice()
    // // Extracts part of an array
    // $arr = [1, 2, 3, 4];
    // print_r(array_slice($arr, 1, 2));

    // // array_splice()  
    // // Removes/replaces part of array 
    // $arr = [1, 2, 3, 4];
    // array_splice($arr, 1, 2);
    // print_r($arr);

    // // array_search()
    // // Searches for a value and returns key
    // $arr = ["a" => "apple", "b" => "banana"];
    // echo array_search("banana", $arr);

    // // array_unique()
    // // Removes duplicate values
    // $arr = [1, 2, 2, 3];
    // print_r(array_unique($arr));

    // // sort()
    // // Sorts array (ascending)
    // $arr = [3, 1, 2];
    // sort($arr);
    // print_r($arr);

    // // rsort()
    // // Sorts array (descending)
    // $arr = [1, 2, 3];
    // rsort($arr);
    // print_r($arr);

    // // asort()
    // // Sorts associative array by value (keeps keys)
    // $arr = ["b" => 2, "a" => 1];
    // asort($arr);
    // print_r($arr);

    // // ksort()
    // // Sorts associative array by key
    // $arr = ["b" => 2, "a" => 1];
    // ksort($arr);
    // print_r($arr);

    // // array_reverse()
    // // Reverses array
    // $arr = [1, 2, 3];
    // print_r(array_reverse($arr));

    // // array_map()
    // // Applies a function to each element
    // $arr = [1, 2, 3];
    // $result = array_map(function($x) {
    //     return $x * 2;
    // }, $arr);

    // print_r($result);
    // create a function having if and else statement for an underage of <=17 having no access to enter club
    // create an if statement for an even and an odd number.

    $num = 10;

    if ($num % 2 == 0) {
        echo "Even number";
    } else {
        echo "Odd number";
    }
    echo "<br>";

    function checkAccess($age) {
        if ($age <= 17) {
            return "No access to enter club";
        } else {
            return "Access granted";
        }
    }
    echo checkAccess(16);
    echo "<br>";
    echo checkAccess(20);

?>
