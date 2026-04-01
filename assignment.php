<?php
    $variable_1 = "My name is";
    $variable_2 = "Sodiq";
    $variable_3 = "Mohammed,";
    $variable_4 = "a student of class'27";
    $variable_5 = "Cybersecurity Student";
    $variable_6 = "I am a:";
    $variable_7 = "Frontend developer,";
    $variable_8 = "Learning backend, and also";
    $variable_9 = "PHP (Hypertext Preprocessor) as the programming language, and this is my";
    $variable_10 = "first class";

    // space function
    echo $variable_1;
    echo " ";
    echo $variable_2;
    echo " ";
    echo $variable_3;
    echo " ";
    echo $variable_4;
    echo " ";
    echo $variable_5;

    // breaking (br) funtion
    echo "<br>";
    echo $variable_6;
    echo "<br>";
    echo $variable_7;
    echo "<br>";
    echo $variable_8;
    echo "<br>";
    echo $variable_9;

    // adding space function and replace function together
    echo " ";
    echo str_replace("class", "assignment", $variable_10)
?>
