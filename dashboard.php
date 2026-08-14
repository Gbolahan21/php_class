<?php 
    include "connect/connect.php";
    session_start();

    if(!isset($_SESSION["email"])) {
        header("Location: signin.php?message=Please login first");
        exit;
    }

    $email = $_SESSION["email"];
    
    $stmt = mysqli_prepare($db_connect, "SELECT * FROM admins WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // pagination
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) {
        $page = 1;
    }
    $limit = 5;
    $offset = ($page - 1) * $limit;

    // Recent activity pagination
    $activityPage = isset($_GET['activity_page'])
        ? (int)$_GET['activity_page']
        : 1;

    if ($activityPage < 1) {
        $activityPage = 1;
    }

    $activityLimit = 5;
    $activityOffset = ($activityPage - 1) * $activityLimit;

    // Count total teachers
    $teacherQuery = mysqli_query($db_connect, "SELECT COUNT(*) AS total FROM teachers");
    $teacherData = mysqli_fetch_assoc($teacherQuery);

    $totalTeachers = $teacherData['total'];
    $teacherLabel = ($totalTeachers == 1) ? "Teacher" : "Teachers";

    // Count total students
    $studentQuery = mysqli_query($db_connect, "SELECT COUNT(*) AS total FROM students");
    $studentData = mysqli_fetch_assoc($studentQuery);

    // Count total activities
    $activityCountQuery = mysqli_query(
        $db_connect,
        "SELECT COUNT(*) AS total FROM students"
    );

    $activityCountData = mysqli_fetch_assoc($activityCountQuery);

    $totalActivities = $activityCountData['total'];

    $totalActivityPages = ceil($totalActivities / $activityLimit);

    $totalStudents = $studentData['total'];
    $studentLabel = ($totalStudents == 1 || $totalStudents == 0) ? "Student" : "Students";
    $totalPages = ceil($totalStudents / $limit);

    $studentsQuery = mysqli_query($db_connect, "SELECT * FROM students ORDER BY id ASC LIMIT $limit OFFSET $offset");

    $recentStudents = mysqli_query($db_connect, "SELECT firstname, lastname, created_at FROM students ORDER BY created_at DESC LIMIT $activityLimit OFFSET $activityOffset");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <title>Document</title>
    </head>
    <body>
        <div class="layout">
            <!-- sidebar -->
            <?php include "includes/sidebar.php"; ?>

            <!-- Main Content -->
            <div class="main-content">
               <!-- navbar -->
                <?php include "includes/navbar.php"; ?>
                <div class="container">
                    <h2 class="page-title">
                        Welcome back, <?php echo htmlspecialchars($user['firstname']); ?>
                        👋
                    </h2>

                    <div class="dashboard-cards">
                        <div class="dashboard-card">
                            <div class="card-icon"><i class="fa-solid fa-user-graduate"></i></div>

                            <div>
                                <h3><?php echo $studentLabel; ?></h3>
                                <h1><?php echo $totalStudents; ?></h1>
                            </div>
                        </div>

                        <div class="dashboard-card">
                            <div class="card-icon"><i class="fa-solid fa-chalkboard-user"></i></div>

                            <div>
                                <h3><?php echo $teacherLabel; ?></h3>
                                <h1><?php echo $totalTeachers; ?></h1>
                            </div>
                        </div>

                        <div class="dashboard-card">
                            <div class="card-icon"><i class="fa-solid fa-book-open"></i></div>

                            <div>
                                <h3>Courses</h3>
                                <h1>18</h1>
                            </div>
                        </div>

                        <div class="dashboard-card">
                            <div class="card-icon"><i class="fa-solid fa-calendar-check"></i></div>
                            <div>
                                <h3>Attendance</h3>
                                <h1>92%</h1>
                            </div>
                        </div>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h2>Recent Students</h2>
                        </div>

                        <div class="table-responsive">
                            <table class="students-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Matric No</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($studentsQuery) > 0): ?>
                                        <?php while ($student = mysqli_fetch_assoc($studentsQuery)): ?>
                                            <tr>
                                                <td><?= str_pad($student['id'], 2, "0", STR_PAD_LEFT); ?></td>
                                                <td>
                                                    <?php if (!empty($student['image'])): ?>
                                                        <img
                                                            src="uploads/students/<?= htmlspecialchars($student['image']); ?>"
                                                            class="student-photo"
                                                            alt="Student Photo"
                                                        >
                                                    <?php else: ?>
                                                        <img
                                                            src="assets/images/default-avatar.png"
                                                            class="student-photo"
                                                            alt="Default Avatar"
                                                        >
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($student['firstname'] . " " . $student['lastname']); ?></td>
                                                <td><?= htmlspecialchars($student['matric_no']); ?></td>
                                                <td><?= htmlspecialchars($student['email']); ?></td>
                                                <td><?= htmlspecialchars($student['department']); ?></td>
                                                <td><?= htmlspecialchars($student['level']); ?></td>
                                                <td>
                                                    <span class="status <?= strtolower($student['status']); ?>">
                                                        <?= htmlspecialchars($student['status']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="action-dropdown">
                                                        <button class="action-toggle">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <div class="action-menu">
                                                            <a
                                                                href="#"
                                                                class="delete-action"
                                                                data-id="<?= $student['id']; ?>"
                                                                data-name="<?= htmlspecialchars($student['firstname'] . ' ' . $student['lastname']); ?>"
                                                                data-email="<?= htmlspecialchars($student['email']); ?>"
                                                            >
                                                                <i class="fa-solid fa-trash"></i>
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" style="text-align:center;padding:30px;">
                                                No students found.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="table-footer">
                        <?php
                            $start = $totalStudents > 0
                                ? $offset + 1
                                : 0;

                            $end = min(
                                $offset + $limit,
                                $totalStudents
                            );
                        ?>
                        <span>
                            Showing <?= $start ?> - <?= $end ?>
                            of <?= $totalStudents ?>
                            <?= $studentLabel ?>
                        </span>
                        <div class="pagination">

                            <!-- Previous -->
                            <?php if ($page > 1): ?>

                                <a href="?page=<?= $page - 1 ?>">
                                    Previous
                                </a>

                            <?php else: ?>

                                <button disabled>
                                    Previous
                                </button>

                            <?php endif; ?>


                            <!-- Page Numbers -->
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                                <?php if ($i == $page): ?>

                                    <a
                                        href="?page=<?= $i ?>"
                                        class="active"
                                    >
                                        <?= $i ?>
                                    </a>

                                <?php else: ?>

                                    <a href="?page=<?= $i ?>">
                                        <?= $i ?>
                                    </a>

                                <?php endif; ?>

                            <?php endfor; ?>


                            <!-- Next -->
                            <?php if ($page < $totalPages): ?>

                                <a href="?page=<?= $page + 1 ?>">
                                    Next
                                </a>

                            <?php else: ?>

                                <button disabled>
                                    Next
                                </button>

                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="activity-card">
                        <div class="activity-header">
                            <h2>Recent Activity</h2>
                        </div>

                        <div class="activity-list">
                            <?php if(mysqli_num_rows($recentStudents) > 0): ?>

                                <?php while($student = mysqli_fetch_assoc($recentStudents)): ?>

                                    <div class="activity-item">

                                        <div class="activity-icon student">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </div>

                                        <div class="activity-info">

                                            <h4>New Student Added</h4>

                                            <p>
                                                <?= htmlspecialchars($student['firstname'] . " " . $student['lastname']); ?>
                                                was registered.
                                            </p>

                                        </div>

                                        <span class="activity-time">

                                            <?= date("M d, Y", strtotime($student['created_at'])); ?>

                                        </span>

                                    </div>

                                <?php endwhile; ?>

                            <?php else: ?>
                                <p style="padding:20px;text-align:center;color:#777;">
                                    No recent activity.
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="table-footer">
                        <?php
                            $activityStart = $totalActivities > 0
                                ? $activityOffset + 1
                                : 0;

                            $activityEnd = min(
                                $activityOffset + $activityLimit,
                                $totalActivities
                            );
                        ?>
                        <span>
                            Showing <?= $activityStart ?> - <?= $activityEnd ?>
                            of <?= $totalActivities ?> Activities
                        </span>
                        <div class="pagination">
                            <?php if ($activityPage > 1): ?>

                            <a href="?page=<?= $page ?>&activity_page=<?= $activityPage - 1 ?>">
                                Previous
                            </a>

                            <?php else: ?>
                                <button disabled>
                                    Previous
                                </button>
                            <?php endif; ?>


                            <?php for ($i = 1; $i <= $totalActivityPages; $i++): ?>

                                <?php if ($i == $activityPage): ?>

                                    <a
                                        href="?page=<?= $page ?>&activity_page=<?= $i ?>"
                                        class="active"
                                    >
                                        <?= $i ?>
                                    </a>

                                <?php else: ?>

                                    <a href="?page=<?= $page ?>&activity_page=<?= $i ?>">
                                        <?= $i ?>
                                    </a>

                                <?php endif; ?>

                            <?php endfor; ?>


                            <?php if ($activityPage < $totalActivityPages): ?>

                                <a href="?page=<?= $page ?>&activity_page=<?= $activityPage + 1 ?>">
                                    Next
                                </a>

                            <?php else: ?>

                                <button disabled>
                                    Next
                                </button>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "includes/modals/delete.php"; ?>
        </div>
        <script src="assets/js/modal.js"></script>
        <script src="assets/js/dashboard.js"></script>
    </body>
</html>