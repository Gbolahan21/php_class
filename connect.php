<?php
    $db_connect = mysqli_connect('localhost', 'root', '', 'attendance');

    if (!$db_connect) {
        echo "Failed to connect to database";
    };
?>