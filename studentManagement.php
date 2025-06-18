<?php
include("connection.php");
session_start();

if (isset($_SESSION["user"])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vertex Institute - Student Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            /* Consistent with previous designs */
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
                transform: translateY(-10px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            }

            .management-icon {
                font-size: 3rem;
                margin-bottom: 20px;
                color: var(--primary-color);
            }

            .card-add {
                border-top: 5px solid #2ecc71;
            }

            .card-search {
                border-top: 5px solid #3498db;
            }

            .card-delete {
                border-top: 5px solid #e74c3c;
            }

            .btn-outline-primary {
                border-color: var(--primary-color);
                color: var(--primary-color);
            }

            .btn-outline-primary:hover {
                background-color: var(--primary-color);
                color: white;
            }
        </style>
    </head>

    <body>
        <!-- Header -->
        <?php include("navbar.php"); ?>

        <!-- Student Management Options -->
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="text-center mb-4"><i class="fas fa-users me-2"></i>Student Management Options</h3>
                    <p class="text-center text-muted">Select an operation to manage student records</p>
                </div>
            </div>

            <div class="row">
                <!-- Add Student Card -->
                <div class="col-md-4 mb-4">
                    <div class="management-card card-add" onclick="location.href='register.php'">
                        <div class="management-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h4>Add New Student</h4>
                        <p class="text-muted">Register a new student to the system with complete details</p>
                        <button class="btn btn-outline-primary mt-3">Go to Registration</button>
                    </div>
                </div>

                <!-- Search Student Card -->
                <div class="col-md-4 mb-4">
                    <div class="management-card card-search" onclick="location.href='searchStudent.php'">
                        <div class="management-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4>Search Student</h4>
                        <p class="text-muted">Find and view student details using NIC or other criteria</p>
                        <button class="btn btn-outline-primary mt-3">Search Records</button>
                    </div>
                </div>

                <!-- Delete Student Card -->
                <div class="col-md-4 mb-4">
                    <div class="management-card card-delete" onclick="location.href='deleteStudent.php'">
                        <div class="management-icon">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <h4>Delete Student</h4>
                        <p class="text-muted">Remove student records from the system (admin only)</p>
                        <button class="btn btn-outline-primary mt-3">Manage Deletions</button>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // You can add any interactive functionality here
            // For example, confirmation before navigating to delete page
            document.querySelector('.card-delete').addEventListener('click', function (e) {
                if (confirm('You are accessing sensitive student deletion tools. Continue?')) {
                    window.location.href = 'deleteStudent.php';
                }
            });
        </script>
    </body>

    </html>

    <?php
} else {
    header("Location: login.php");
}

?>