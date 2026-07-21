<?php

    $grade = 22;
    $word = "You get " . ($grade % 2 == 0 ? "an" : "a");

    if ($grade >= 70) {
        echo $word . " Excellent (A)";
    } else if ($grade <= 69 && $grade >= 60) {
        echo $word . " Very Good (B)";
    } else if ($grade <= 59 && $grade >= 50) {
        echo $word . " Good (C)";
    } else if ($grade <= 49 && $grade >= 45) {
        echo $word . " Fair (D)";
    } else if ($grade <= 44 && $grade >= 40) {
        echo $word . " Poor (E)";
    } else {
        echo $word . " Fail (F)";
    }
?>