<?php
session_start();
include("connection.php");
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vertex Institute - Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            :root {
                --primary-color: #2c3e50;
                --secondary-color: #3498db;
                --accent-color: #e74c3c;
                --light-bg: #f8f9fa;
                --dark-bg: #343a40;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: var(--light-bg);
            }

            /* Sidebar */
            .sidebar {
                background-color: var(--primary-color);
                color: white;
                height: 100vh;
                position: fixed;
                width: 250px;
                transition: all 0.3s;
                z-index: 1000;
            }

            .sidebar-header {
                padding: 20px;
                background-color: rgba(0, 0, 0, 0.2);
            }

            .sidebar-menu {
                padding: 0;
                list-style: none;
            }

            .sidebar-menu li {
                padding: 10px 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.3s;
            }

            .sidebar-menu li:hover {
                background-color: rgba(0, 0, 0, 0.2);
            }

            .sidebar-menu li a {
                color: white;
                text-decoration: none;
                display: block;
            }

            .sidebar-menu li i {
                margin-right: 10px;
                width: 20px;
                text-align: center;
            }

            .sidebar-menu li.active {
                background-color: var(--secondary-color);
            }

            /* Main Content */
            .main-content {
                margin-left: 250px;
                padding: 20px;
                transition: all 0.3s;
            }

            /* Top Navigation */
            .top-nav {
                background-color: white;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .profile-dropdown img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                margin-right: 10px;
            }

            /* Dashboard Cards */
            .dashboard-card {
                border: none;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: all 0.3s;
                margin-bottom: 20px;
            }

            .dashboard-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .dashboard-card .card-body {
                padding: 20px;
            }

            .card-icon {
                font-size: 2rem;
                margin-bottom: 15px;
            }

            /* Charts */
            .chart-container {
                position: relative;
                height: 300px;
                width: 100%;
            }

            /* Tables */
            .data-table {
                width: 100%;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .sidebar {
                    margin-left: -250px;
                }

                .sidebar.active {
                    margin-left: 0;
                }

                .main-content {
                    margin-left: 0;
                }

                .main-content.active {
                    margin-left: 250px;
                }
            }
        </style>
    </head>

    <body>
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header text-center">
                <img src="resources/logo.png" alt="Vertex Institute Logo" width="180" class="img-fluid rounded-circle mb-2">
                <h5 class="mt-2">Vertex Institute</h5>
                <p class="text-muted small">Admin Dashboard</p>
            </div>

            <ul class="sidebar-menu">
                <li class="active">
                    <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="studentManagement.php"><i class="fas fa-users"></i> Students</a>
                </li>
                <li>
                    <a href="instructorManagement.php"><i class="fas fa-chalkboard-teacher"></i> Instructor</a>
                </li>
                <li>
                    <a href="courseManagement.php"><i class="fas fa-book"></i> Courses</a>
                </li>

                <li>
                    <a href="logOutProcess.php" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navigation -->
            <div class="top-nav">
                <div>
                    <button class="btn btn-sm btn-outline-secondary d-md-none" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span id="datetime" class="ms-3"></span>
                </div>

                <div class="dropdown profile-dropdown">
                    <?php
                    $user = $_SESSION["user"];
                    $username = $user["username"];
                    $password = $user["password"];

                    $rs = DataBase::search("SELECT * FROM `admin` WHERE `username` = '" . $username . "' AND `password` = '" . $password . "' ");
                    $rows = $rs->num_rows;
                    if ($rows > 0) {
                        $data = $rs->fetch_assoc();
                    }
                    ?>
                    <a class="dropdown-toggle d-flex align-items-center text-decoration-none" href="#" role="button" id="profileDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $data["image"]; ?>" alt="Admin Profile">
                        <div>
                            <h6 class="mb-0"><?php echo $data["firstname"] . " " . $data["lastname"]; ?></h6>
                            <small class="text-muted">Administrator</small>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="adminprofile.php"><i class="fas fa-user-circle me-2"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="logOutProcess.php" id="profileLogoutBtn"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>

            <!-- Welcome Message -->
            <div class="alert alert-primary">
                <h4><i class="fas fa-graduation-cap me-2"></i> Welcome back,
                    <?php echo $data["firstname"] . " " . $data["lastname"]; ?>!
                </h4>
            </div>

            <!-- Stats Cards -->
            <?php
            $rs = DataBase::search("SELECT
  COUNT(DISTINCT student.nic) AS TotalOfStudents,
  COUNT(DISTINCT instructor.id) AS TotalOfInstructors,
  COUNT(DISTINCT course.id) AS TotalOfCourses,
  SUM(DISTINCT course.max_student) AS TotalOfStudentCapacity
FROM course
INNER JOIN instructor ON instructor.id = course.instructor
LEFT JOIN student ON student.course_id = course.id;
");
            $data = $rs->fetch_assoc();
            ?>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card card">
                        <div class="card-body text-center">
                            <div class="card-icon text-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3><?php echo $data["TotalOfStudents"] ?></h3>
                            <p class="text-muted">Total Students</p>
                            <a href="studentManagement.php" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card card">
                        <div class="card-body text-center">
                            <div class="card-icon text-success">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h3><?php echo $data["TotalOfInstructors"] ?></h3>
                            <p class="text-muted">Total Instructors</p>
                            <a href="instructorManagement.php" class="btn btn-sm btn-outline-success">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card card">
                        <div class="card-body text-center">
                            <div class="card-icon text-info">
                                <i class="fas fa-book"></i>
                            </div>
                            <h3><?php echo $data["TotalOfCourses"]; ?></h3>
                            <p class="text-muted">Active Courses</p>
                            <a href="courseManagement.php" class="btn btn-sm btn-outline-info">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card card">
                        <div class="card-body text-center">
                            <div class="card-icon text-warning">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3><?php echo $data["TotalOfStudentCapacity"]; ?></h3>
                            <p class="text-muted">Maximum Capacity</p>
                            <a href="#" class="btn btn-sm btn-outline-warning">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="dashboard-card card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 text-center">Gender Distribution</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="genderChart" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="dashboard-card card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Student Distribution (Program-wise)</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="studentChart" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="dashboard-card card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Instructor Distribution (Program-wise)</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="instructorChart" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tables Row -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="dashboard-card card">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">New Messages</h5>
                            <a href="Messages.php" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Issue</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $rs = DataBase::search("SELECT * FROM `messages` ORDER BY `messages`.`added_time` DESC LIMIT 5");
                                        $rows = $rs->num_rows;
                                        if ($rows > 0) {
                                            for ($i = 0; $i < $rows; $i++) {
                                                $data = $rs->fetch_assoc();
                                                ?>
                                                <tr>
                                                    <td><?php echo $data["name"]; ?></td>
                                                    <td><?php echo $data["email"]; ?></td>
                                                    <td><?php echo $data["subject"]; ?></td>
                                                    <td><?php echo $data["message"]; ?></td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    
                </div>
                <div class="col-lg-7">
                    <div class="dashboard-card card">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Newsletter Subscribers</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table data-table">
                                    <thead>
                                        <tr>
                                            <th>Subscriber ID</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $rs = DataBase::search("SELECT * FROM `newsletter` ORDER BY `newsletter`.`email` DESC LIMIT 10");
                                        $rows = $rs->num_rows;
                                        if ($rows > 0) {
                                            for ($i = 0; $i < $rows; $i++) {
                                                $data = $rs->fetch_assoc();
                                                ?>
                                                <tr>
                                                    <td><?php echo $data["id"]; ?></td>
                                                    <td><?php echo $data["email"]; ?></td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart -->
                <div class="col-lg-5">
                    <div class="dashboard-card card">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Active Courses</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="activeCoursesChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <!--  -->

            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="dashboard-card card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                <a class="btn btn-primary" href="register.php"><i class="fas fa-user-plus me-2"></i> Add New
                                    Student</a>
                                <a class="btn btn-success" href="register.php"><i class="fas fa-user-plus me-2"></i> Search
                                    Student</a>
                                <a class="btn btn-info" href="courseRegister.php"><i class="fas fa-book-medical me-2" ></i> Create
                                    Course</a>
                                <a class="btn btn-warning" href="edit-course.php"><i class="fas fa-book-medical me-2"></i> Add Course Content
                                    </a>
                                <a class="btn btn-danger" href="instructor.php"><i class="fas fa-user-plus me-2"></i> Add Instructor
                                    </a>
                                <a class="btn btn-secondary" href="SearchInstructor.php"><i class="fas fa-user-plus me-2"></i> Edit Instructor Detils
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Chart  -->
        <?php
        // Students per course
        $rs1 = DataBase::search("
    SELECT course.course_name, COUNT(student.nic) AS student_count
    FROM course
    LEFT JOIN student ON course.id = student.course_id
    GROUP BY course.id
");

        $courseNames = [];
        $studentCounts = [];

        while ($row = $rs1->fetch_assoc()) {
            $courseNames[] = $row['course_name'];
            $studentCounts[] = $row['student_count'];
        }

        // Instructors per course
        $rs2 = DataBase::search("
    SELECT course.course_name, COUNT(DISTINCT course.instructor) AS instructor_count
    FROM course
    GROUP BY course.id
");

        $instructorCounts = [];

        while ($row = $rs2->fetch_assoc()) {
            $instructorCounts[] = $row['instructor_count'];
        }

        $rs3 = DataBase::search("
    SELECT gender.gender_name, COUNT(student.gender_id) AS gender_count
    FROM gender
    INNER JOIN student ON student.gender_id = gender.id
    GROUP BY gender.gender_name
");

        $genderLabels = [];
        $genderCounts = [];

        while ($row = $rs3->fetch_assoc()) {
            $genderLabels[] = $row['gender_name'];
            $genderCounts[] = $row['gender_count'];
        }
        $rs4 = DataBase::search("
    SELECT course.course_name, COUNT(*) AS course_count
    FROM course
    INNER JOIN status ON course.status_id = status.id
    WHERE status.status_name = 'Active'
    GROUP BY course.course_name
");

        $activeCourseLabels = [];
        $activeCourseCounts = [];

        while ($row = $rs4->fetch_assoc()) {
            $activeCourseLabels[] = $row['course_name'];
            $activeCourseCounts[] = $row['course_count'];
        }
        ?>
        <!-- Chart -->

        <!-- JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // Sidebar Toggle
            document.getElementById('sidebarToggle').addEventListener('click', function () {
                document.querySelector('.sidebar').classList.toggle('active');
                document.querySelector('.main-content').classList.toggle('active');
            });

            // Date and Time
            function updateDateTime() {
                const now = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                };
                document.getElementById('datetime').textContent = now.toLocaleDateString('en-US', options);
            }

            setInterval(updateDateTime, 1000);
            updateDateTime();



            // Charts
            const genderCtx = document.getElementById('genderChart').getContext('2d');

            const genderChart = new Chart(genderCtx, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($genderLabels); ?>,
                    datasets: [{
                        data: <?php echo json_encode($genderCounts); ?>,
                        backgroundColor: ['#3498db', '#e91e63', '#9b59b6', '#f39c12', '#1abc9c'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'none'
                        }
                    }
                }
            });
            //active course
            const activeCoursesCtx = document.getElementById('activeCoursesChart').getContext('2d');

            const activeCoursesChart = new Chart(activeCoursesCtx, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($activeCourseLabels); ?>,
                    datasets: [{
                        data: <?php echo json_encode($activeCourseCounts); ?>,
                        backgroundColor: [
                            '#3498db', '#2ecc71', '#f1c40f', '#e74c3c', '#9b59b6', '#1abc9c', '#e67e22'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'none' }
                    }
                }
            });

            // Program Chart

            const courseLabels = <?php echo json_encode($courseNames); ?>;
            const studentData = <?php echo json_encode($studentCounts); ?>;
            const instructorData = <?php echo json_encode($instructorCounts); ?>;

            const studentChart = new Chart(document.getElementById('studentChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: courseLabels,
                    datasets: [{
                        data: studentData,
                        backgroundColor: ['#3498db', '#2ecc71', '#f1c40f', '#e74c3c', '#9b59b6', '#95a5a6'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'none' }
                    }
                }
            });

            const instructorChart = new Chart(document.getElementById('instructorChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: courseLabels,
                    datasets: [{
                        data: instructorData,
                        backgroundColor: ['#1abc9c', '#e67e22', '#9b59b6', '#34495e', '#f39c12', '#7f8c8d'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'none' }
                    }
                }
            });

        </script>
    </body>

    </html>

    <?php
}
?>