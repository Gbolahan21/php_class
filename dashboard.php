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
                                <h3>Students</h3>
                                <h1>320</h1>
                            </div>
                        </div>

                        <div class="dashboard-card">
                            <div class="card-icon"><i class="fa-solid fa-chalkboard-user"></i></div>

                            <div>
                                <h3>Teachers</h3>
                                <h1>24</h1>
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

                            <a href="students.php" class="view-all">
                                View All
                            </a>
                        </div>

                        <table class="students-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>Computer Science</td>
                                    <td>300</td>
                                    <td>
                                        <span class="status active">
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-dropdown">
                                            <button class="action-toggle">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="action-menu">
                                                <a href="#">
                                                    <i class="fa-solid fa-eye"></i> View
                                                </a>

                                                <a href="#">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </a>

                                                <a href="#" class="delete-action">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Mary Jane</td>
                                    <td>Accounting</td>
                                    <td>200</td>
                                    <td>
                                        <span class="status active">
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-dropdown">
                                            <button class="action-toggle">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="action-menu">
                                                <a href="#">
                                                    <i class="fa-solid fa-eye"></i> View
                                                </a>

                                                <a href="#">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </a>

                                                <a href="#" class="delete-action">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>James Paul</td>
                                    <td>Biology</td>
                                    <td>100</td>
                                    <td>
                                        <span class="status inactive">
                                            Inactive
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-dropdown">
                                            <button class="action-toggle">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="action-menu">
                                                <a href="#">
                                                    <i class="fa-solid fa-eye"></i> View
                                                </a>

                                                <a href="#">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </a>

                                                <a href="#" class="delete-action">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="activity-card">
                        <div class="activity-header">
                            <h2>Recent Activity</h2>
                        </div>

                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon student">
                                    <i class="fa-solid fa-user-plus"></i>
                                </div>

                                <div class="activity-info">
                                    <h4>New Student Added</h4>
                                    <p>John Doe was registered.</p>
                                </div>

                                <span class="activity-time">
                                    10 mins ago
                                </span>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon attendance">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>

                                <div class="activity-info">
                                    <h4>Attendance Recorded</h4>
                                    <p>Computer Science 300 Level.</p>
                                </div>

                                <span class="activity-time">
                                    35 mins ago
                                </span>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon course">
                                    <i class="fa-solid fa-book-open"></i>
                                </div>

                                <div class="activity-info">
                                    <h4>Course Updated</h4>
                                    <p>CSC 401 was modified.</p>
                                </div>

                                <span class="activity-time">
                                    Yesterday
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>