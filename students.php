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

    // Count total students
    $studentQuery = mysqli_query($db_connect, "SELECT COUNT(*) AS total FROM students");
    $studentData = mysqli_fetch_assoc($studentQuery);

    $totalStudents = $studentData['total'];
    $studentLabel = ($totalStudents == 1 || $totalStudents == 0) ? "Student" : "Students";

    $studentsQuery = mysqli_query(
        $db_connect,
        "SELECT * FROM students ORDER BY id DESC"
    );
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

                        <div class="search-box">
                            <i class="fa-solid fa-magnifying-glass"></i>

                            <input type="text" placeholder="Search students..."
                            >
                        </div>

                        <div class="filter-dropdown">

                            <button class="filter-toggle">
                                <span>Department</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>

                            <div class="filter-menu">

                                <a href="#">Computer Science</a>
                                <a href="#">Cybersecurity</a>
                                <a href="#">Accounting</a>
                                <a href="#">Biology</a>

                            </div>

                        </div>

                        <div class="filter-dropdown">

                            <button class="filter-toggle">
                                <span>Level</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>

                            <div class="filter-menu">

                                <a href="#">100</a>
                                <a href="#">200</a>
                                <a href="#">300</a>
                                <a href="#">400</a>
                                <a href="#">500</a>
                                <a href="#">600</a>

                            </div>

                        </div>

                        <div class="filter-dropdown">

                            <button class="filter-toggle">
                                <span>Status</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>

                            <div class="filter-menu">

                                <a href="#">Active</a>
                                <a href="#">Inactive</a>

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
                                                            <a href="#">
                                                                <i class="fa-solid fa-eye"></i>
                                                                View
                                                            </a>
                                                            <a href="#">
                                                                <i class="fa-solid fa-pen"></i>
                                                                Edit
                                                            </a>
                                                            <a href="#">
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

                        <span>
                            Showing 1 - 10 of 320 students
                        </span>

                        <div class="pagination">

                            <button>
                                Previous
                            </button>

                            <button class="active">
                                1
                            </button>

                            <button>
                                2
                            </button>

                            <button>
                                3
                            </button>

                            <button>
                                Next
                            </button>

                        </div>

                    </div>
                </div>
            </div>
            <?php include "includes/modals/addStudent.php"; ?>
        </div>
        <script src="assets/js/filter.js"></script>
        <script src="assets/js/students.js"></script>
        <script src="assets/js/dropdown.js"></script>
        <script src="assets/js/modal.js"></script>
        <script src="assets/js/imagePreview.js"></script>
        <script src="assets/js/dashboard.js"></script>
    </body>
</html>