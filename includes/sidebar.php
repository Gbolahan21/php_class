<?php
    $currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/includes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-logo">
            <i class="fa-solid fa-school"></i>
            <span>MOH</span>
        </div>

        <ul class="sidebar-menu">

            <li class="<?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
                <a href="dashboard.php"><i class="fa-solid fa-gauge-high"></i>Dashboard</a>
            </li>

            <li class="<?= $currentPage == 'students.php' ? 'active' : '' ?>">
                <a href="students.php"><i class="fa-solid fa-user-graduate"></i>Students</a>
            </li>

            <li class="<?= $currentPage == 'teachers.php' ? 'active' : '' ?>">
                <a href="teachers.php"><i class="fa-solid fa-chalkboard-user"></i>Teachers</a>
            </li>

            <li class="<?= $currentPage == 'departments.php' ? 'active' : '' ?>">
                <a href="departments.php"><i class="fa-solid fa-building"></i>Departments</a>
            </li>

            <li class="<?= $currentPage == 'courses.php' ? 'active' : '' ?>">
                <a href="courses.php"><i class="fa-solid fa-book-open"></i>Courses</a>
            </li>

            <li class="<?= $currentPage == 'attendance.php' ? 'active' : '' ?>">
                <a href="attendance.php"><i class="fa-solid fa-calendar-check"></i>Attendance</a>
            </li>

            <li class="<?= $currentPage == 'results.php' ? 'active' : '' ?>">
                <a href="results.php"><i class="fa-solid fa-square-poll-vertical"></i>Results</a>
            </li>

            <li class="<?= $currentPage == 'reports.php' ? 'active' : '' ?>">
                <a href="reports.php"><i class="fa-solid fa-chart-line"></i>Reports</a>
            </li>

            <li class="<?= $currentPage == 'settings.php' ? 'active' : '' ?>">
                <a href="settings.php"><i class="fa-solid fa-gear"></i>Settings</a>
            </li>

        </ul>
    </aside>
</body>
</html>