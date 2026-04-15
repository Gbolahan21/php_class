<!-- for loop -->
<?php
    for ($i = 1; $i <= 5; $i++) {
        echo "Number: $i <br>";
    }
?>

<!-- while loop -->
<?php
    $i = 1;
    while ($i <= 10) {
        echo "Number: $i <br>";
        $i++;
    }
?>

<!-- do-while loop -->
<?php
    $i = 1;
    do {
        echo "Number: $i <br>";
        $i++;
    } while ($i <= 4);
?>

<!-- foreach loop -->
<?php
    $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    foreach ($numbers as $number) {
        echo "Number: $number <br>";
    }
?>

<!-- break (stop loop) -->
<?php
    for ($i = 1; $i <= 5; $i++) {
        if ($i == 3) {
            break;
        }
        echo "Number: $i <br>";
    }
?>


<!-- continue (skip current iteration) -->
<?php
    for ($i = 1; $i <= 5; $i++) {
        if ($i == 3) {
            continue;
        }
        echo "Number: $i <br>";
    }
?>