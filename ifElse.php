<?php
    $grade = 32;

    if ($grade > 60) {
        echo "Excellent";
    } else if ($grade > 50) {
        echo "Good";
    }  else if (($grade < 60) && ($grade > 50)) {
        echo "Good";
    } else if (($grade < 50) && ($grade > 40)) {
        echo "Average";
    } else if (($grade < 40) && ($grade > 30)) {
        echo "Pass";
    } else if (($grade < 30) && ($grade > 20)) {
        echo "Fail";
    } else {
        echo "Advice to withdraw";
    };
?>