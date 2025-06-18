<?php
include("connection.php");
session_start();
if (isset($_SESSION["user"])) {
    ?>
    <!-- Design -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vertex Institute - Course Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            :root {
                --primary-color: #2c3e50;
                --secondary-color: #3498db;
                --accent-color: #e74c3c;
            }

            .header {
                background-color: var(--primary-color);
                color: white;
                padding: 20px 0;
                margin-bottom: 30px;
            }

            .management-card {
                border: none;
                border-radius: 10px;
                overflow: hidden;
                transition: all 0.3s ease;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                height: 100%;
                text-align: center;
                padding: 30px 20px;
                cursor: pointer;
            }

            .management-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            }

            .management-icon {
                font-size: 2.5rem;
                margin-bottom: 15px;
                color: var(--primary-color);
            }

            .card-add {
                border-top: 4px solid #2ecc71;
            }

            .card-edit {
                border-top: 4px solid #f39c12;
            }

            .card-view {
                border-top: 4px solid #3498db;
            }

            .chart-container {
                position: relative;
                height: 350px;
                margin-bottom: 30px;
            }

            .course-table th {
                background-color: var(--primary-color);
                color: white;
            }

            .action-btns .btn {
                margin-right: 5px;
                margin-bottom: 5px;
            }

            .badge-enrolled {
                background-color: #2ecc71;
            }

            .badge-capacity {
                background-color: #3498db;
            }
        </style>
    </head>

    <body>
        <!-- Header -->
        <?php include("navbar.php"); ?>

        <div class="container">
            <!-- Course Management Options -->
            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="text-center mb-4"><i class="fas fa-book me-2"></i>Course Management</h3>
                    <p class="text-center text-muted">Manage all academic programs and courses</p>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="management-card card-add" onclick="location.href='courseRegister.php'">
                        <div class="management-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <h4>Add New Course</h4>
                        <p>Create a new academic course with detailed specifications</p>
                        <button class="btn btn-outline-success mt-2">
                            <i class="fas fa-plus me-1"></i> Add Course
                        </button>
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="management-card card-edit" onclick="location.href='edit-course.php'">
                        <div class="management-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h4>Edit Courses</h4>
                        <p>Modify existing course details, syllabus, or requirements</p>
                        <button class="btn btn-outline-warning mt-2">
                            <i class="fas fa-pencil-alt me-1"></i> Edit Courses
                        </button>
                    </div>
                </div>

            </div>

            <!-- Current Courses Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-5">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-list-alt me-2"></i>Current Courses</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table course-table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Course Code</th>
                                            <th>Course Name</th>
                                            <th>Instructor</th>
                                            <th>Course Fee</th>
                                            <th>Enrollment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $rs = DataBase::search("
    SELECT 
        course.id AS course_id, 
        course.course_name, 
        course.course_fee, 
        course.max_student, 
        instructor.firstname, 
        instructor.lastname, 
        status.status_name 
    FROM course 
    INNER JOIN instructor ON course.instructor = instructor.id 
    INNER JOIN status ON course.status_id = status.id
");

                                        $rows = $rs->num_rows;
                                        if ($rows > 0) {
                                            for ($i = 0; $i < $rows; $i++) {
                                                $data = $rs->fetch_assoc();
                                                ?>
                                                <tr>
                                                    <td><?php echo $data["course_id"]; ?></td>
                                                    <td><?php echo $data["course_name"]; ?></td>
                                                    <td><?php echo $data["firstname"] . " " . $data["lastname"]; ?></td>
                                                    <td><?php echo $data["course_fee"]; ?></td>
                                                    <td>
                                                        <span
                                                            class="badge badge-enrolled rounded-pill"><?php echo $data["max_student"]; ?></span>
                                                    </td>
                                                    <td><span class="badge bg-success"><?php echo $data["status_name"]; ?></span>
                                                    </td>
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
            </div>




            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </body>

    </html>
    <!-- Design -->
    <?php
}
?>