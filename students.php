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

    // Count total students
    $studentQuery = mysqli_query($db_connect, "SELECT COUNT(*) AS total FROM students");
    $studentData = mysqli_fetch_assoc($studentQuery);

    $totalStudents = $studentData['total'];
    $studentLabel = ($totalStudents == 1 || $totalStudents == 0) ? "Student" : "Students";
    $totalPages = ceil($totalStudents / $limit);

    $studentsQuery = mysqli_query($db_connect, "SELECT * FROM students ORDER BY id ASC LIMIT $limit OFFSET $offset");
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
                    <div class="page-header">
                        <div>
                            <h2>Students</h2>
                            <p>Manage all registered students.</p>
                        </div>

                        <button class="btn btn-primary" id="addStudentBtn">
                            <i class="fa-solid fa-plus"></i>
                            Add Student
                        </button>
                    </div>

                    <div class="filter-bar">

                        <!-- search -->
                        <div class="search-box">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search students..." id="studentSearch">
                        </div>

                        <!-- Department Filter -->
                        <div class="filter-dropdown">

                            <button class="filter-toggle">
                                <span>Department</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>

                            <div class="filter-menu">

                                <a href="#" data-filter="department" data-value="computer science">Computer Science</a>
                                <a href="#" data-filter="department" data-value="cybersecurity">Cybersecurity</a>
                                <a href="#" data-filter="department" data-value="accounting">Accounting</a>
                                <a href="#" data-filter="department" data-value="biology">Biology</a>

                            </div>

                        </div>

                        <!-- Level Filter -->
                        <div class="filter-dropdown">

                            <button class="filter-toggle">
                                <span>Level</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>

                            <div class="filter-menu">

                                <a href="#" data-filter="level" data-value="100">100</a>
                                <a href="#" data-filter="level" data-value="200">200</a>
                                <a href="#" data-filter="level" data-value="300">300</a>
                                <a href="#" data-filter="level" data-value="400">400</a>
                                <a href="#" data-filter="level" data-value="500">500</a>
                                <a href="#" data-filter="level" data-value="600">600</a>

                            </div>

                        </div>

                        <!-- Status Filter -->
                        <div class="filter-dropdown">

                            <button class="filter-toggle">
                                <span>Status</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>

                            <div class="filter-menu">

                                <a href="#" data-filter="status" data-value="all">All</a>
                                <a href="#" data-filter="status" data-value="active">Active</a>
                                <a href="#" data-filter="status" data-value="inactive">Inactive</a>

                            </div>

                        </div>
                    </div>
                    
                    <div class="table-card">
                        <div class="table-header">
                            <h3>Student List</h3>
                            <span>Total: <?php echo $totalStudents . " " . $studentLabel; ?></span>
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
                                           <tr
                                                data-department="<?= htmlspecialchars($student['department']); ?>"
                                                data-level="<?= htmlspecialchars($student['level']); ?>"
                                                data-status="<?= htmlspecialchars($student['status']); ?>"
                                            >
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
                                                                class="edit-student"
                                                                data-id="<?= $student['id']; ?>"
                                                                data-matric="<?= htmlspecialchars($student['matric_no']); ?>"
                                                                data-firstname="<?= htmlspecialchars($student['firstname']); ?>"
                                                                data-lastname="<?= htmlspecialchars($student['lastname']); ?>"
                                                                data-email="<?= htmlspecialchars($student['email']); ?>"
                                                                data-gender="<?= htmlspecialchars($student['gender']); ?>"
                                                                data-department="<?= htmlspecialchars($student['department']); ?>"
                                                                data-level="<?= htmlspecialchars($student['level']); ?>"
                                                                data-status="<?= htmlspecialchars($student['status']); ?>"
                                                            >
                                                                <i class="fa-solid fa-pen"></i>
                                                                Edit
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
                </div>
            </div>
            <?php include "includes/modals/addStudent.php"; ?>
            <?php include "includes/modals/edit.php"; ?>
        </div>
        <script src="assets/js/filter.js"></script>
        <script src="assets/js/students.js"></script>
        <script src="assets/js/dropdown.js"></script>
        <script src="assets/js/modal.js"></script>
        <script src="assets/js/imagePreview.js"></script>
        <script src="assets/js/dashboard.js"></script>
    </body>
</html>