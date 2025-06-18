<?php
include("connection.php");
session_start();
if (isset($_SESSION["user"])) {
    $courseId = "";
    ?>
    <!-- Design -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vertex Institute - Edit Course</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            :root {
                --primary-color: #2c3e50;
                --secondary-color: #3498db;
                --accent-color: #e74c3c;
            }

            body {
                background-color: #f8f9fa;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .header {
                background-color: var(--primary-color);
                color: white;
                padding: 20px 0;
                margin-bottom: 30px;
            }

            .edit-course-container {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                padding: 30px;
                margin-bottom: 30px;
            }

            .form-section {
                margin-bottom: 30px;
                padding-bottom: 20px;
                border-bottom: 1px solid #eee;
            }

            .form-section h4 {
                color: var(--primary-color);
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 2px solid var(--secondary-color);
            }

            .syllabus-item {
                background-color: #f8f9fa;
                border-radius: 5px;
                padding: 15px;
                margin-bottom: 15px;
                border-left: 3px solid var(--secondary-color);
            }

            .resource-preview {
                width: 100px;
                height: 80px;
                object-fit: cover;
                border-radius: 5px;
                margin-right: 10px;
            }

            .file-upload-box {
                border: 2px dashed #ddd;
                border-radius: 5px;
                padding: 30px;
                text-align: center;
                cursor: pointer;
                transition: all 0.3s;
                margin-bottom: 20px;
            }

            .file-upload-box:hover {
                border-color: var(--secondary-color);
                background-color: rgba(52, 152, 219, 0.05);
            }

            .instructor-card {
                border: none;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                transition: all 0.3s;
            }

            .instructor-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .instructor-img {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                object-fit: cover;
                border: 3px solid white;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .stats-card {
                background-color: white;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                margin-bottom: 20px;
            }

            .stats-card h5 {
                color: var(--primary-color);
                font-size: 1rem;
            }

            .stats-card p {
                font-size: 1.5rem;
                font-weight: bold;
                margin-bottom: 0;
            }

            .btn-save {
                background-color: var(--secondary-color);
                color: white;
                padding: 10px 30px;
                font-weight: 600;
            }

            .btn-save:hover {
                background-color: #2980b9;
                color: white;
            }
        </style>
    </head>

    <body>
        <!-- Header -->
         <?php include("navbar.php"); ?>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Course Selection -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-search me-2"></i>Select Course</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="courseSelect" class="form-label">Choose Course to Edit</label>
                                <select class="form-select" id="courseSelect" onchange="showCourseDetails(this.value)">
                                    <option value="" selected disabled>Select Course</option>
                                    <?php
                                    $rs = DataBase::search("SELECT * FROM `course`");
                                    $rows = $rs->num_rows;
                                    for ($i = 0; $i < $rows; $i++) {
                                        $data = $rs->fetch_assoc();
                                        $courseId = $data["id"];
                                        ?>
                                        <option value="<?php echo $data["id"]; ?>">
                                            <?php echo $data["course_name"] . ": " . $data["id"] . " "; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <!-- Course Quick Stats -->
                            <div id="courseStats" class="d-none">
                                <div class="stats-card">
                                    <h5><i class="fas fa-users me-2"></i>Maximum Enrollment</h5>
                                    <p id="enrollmentCount">0</p>
                                </div>
                                <div class="stats-card">
                                    <h5><i class="fas fa-check-circle me-2"></i>Course Status</h5>
                                    <p id="courseRating" >0.0</p>
                                </div>
                                <div class="stats-card">
                                    <h5><i class="fas fa-hourglass-half me-2"></i>Last Updated</h5>
                                    <p id="lastUpdated">Never</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Instructor Assignment -->
                    <div class="card mb-4 d-none" id="instructorSection">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i>Course Instructor</h5>
                        </div>
                        <div class="card-body">
                            <div id="assignedInstructor">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Instructor"
                                        class="instructor-img me-3" id="inst-image">
                                    <div>
                                        <h6 class="mb-0" id="instructorName">Dr. Robert Chen</h6>
                                        <small class="text-muted" id="instructorTitle">AI Department Head</small>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="instructorSelect" class="form-label">Change Instructor</label>
                                    <select class="form-select" id="instructorSelect">
                                        <?php
                                        $rs = DataBase::search("SELECT * FROM `instructor`");
                                        $rows = $rs->num_rows;
                                        for ($x = 0; $x < $rows; $x++) {
                                            $data = $rs->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $data["id"]; ?>">
                                                <?php echo $data["firstname"] . " " . $data["lastname"]; ?>
                                            </option>
                                            <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <button class="btn btn-sm btn-outline-primary w-100"
                                    onclick="UpdateInstructorDetailsOption();">
                                    Update Instructor
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Edit Form -->
                <div class="col-md-8">
                    <div class="edit-course-container d-none" id="editForm">
                        <form id="courseEditForm">
                            <!-- Basic Information Section -->
                            <div class="form-section">
                                <h4><i class="fas fa-info-circle me-2"></i>Basic Information</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="courseTitle" class="form-label">Course Title</label>
                                        <input type="text" class="form-control" id="courseTitle" placeholder="Course Title">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="courseCode" class="form-label">Course ID</label>
                                        <input type="text" class="form-control" id="courseCode" placeholder="AI-401"
                                            readonly disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="courseInstructor" class="form-label">Instructor Id</label>
                                        <input type="text" class="form-control" id="courseInstructor"
                                            placeholder="Dr. Robert Chen" readonly disabled />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="courseFee" class="form-label">Course Fee</label>
                                        <input type="text" class="form-control" id="courseFee" placeholder="Rs.199.99"
                                            readonly disabled />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="courseDescription" class="form-label">Course Description</label>
                                    <textarea class="form-control" id="courseDescription"
                                        rows="4">This course provides a broad introduction to machine learning, data mining, and statistical pattern recognition. Topics include supervised and unsupervised learning algorithms with practical implementation in Python.</textarea>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary rounded-2 h-auto" onclick="UpdateCourseDetailsOption();">
                                        Update Course Details </button>
                                </div>
                            </div>

                            <!-- Pricing & Capacity Section -->
                            <div class="form-section">
                                <h4><i class="fas fa-tag me-2"></i>Pricing & Capacity</h4>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="courseFee1" class="form-label">Course Fee ($)</label>
                                        <input type="number" class="form-control" id="courseFee1" value="199">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="maxStudents" class="form-label">Maximum Students</label>
                                        <input type="number" class="form-control" id="maxStudents" value="50">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="discount" class="form-label">Early Bird Discount (%)</label>
                                        <input type="number" class="form-control" id="discount" value="15">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <button class="btn btn-primary" onclick="updatePricing();">Update Course
                                            Pricing</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Syllabus & Content Section -->
                            <div class="form-section">
                                <h4><i class="fas fa-list-ol me-2"></i>Syllabus & Content</h4>

                                <div id="syllabusItems">
                                    <!-- Add Week Modal -->

                                    <!-- <div class="syllabus-item mb-4 border p-3 rounded">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 id="WeekHeaader">Add Week</h5>
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addWeek(this);">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Week Title</label>
                                            <input type="text" class="form-control mb-2 weekTitle" id="weekTitle" >
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control mb-2 weekDescription" rows="2" id="weekDescription"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Video Lecture</label>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control videoLink" id="videoLink">
                                                <button class="btn btn-outline-secondary file-btn copy-btn" type="button">
                                                    <i class="fas fa-link"></i>
                                                </button>
                                                <input type="file" class="fileInput d-none">
                                            </div>

                                        </div>

                                    </div>


                                    Add Week Modal -->
                                    <template id="weekTemplate">
                                        <div class="syllabus-item mb-4 border p-3 rounded">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h5 class="WeekHeader">Add Week</h5>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    onclick="addWeek(this);">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Week Title</label>
                                                <input type="text" class="form-control mb-2 weekTitle">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control mb-2 weekDescription" rows="2"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Video Lecture</label>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control videoLink">
                                                    <button class="btn btn-outline-secondary file-btn copy-btn"
                                                        type="button">
                                                        <i class="fas fa-link"></i>
                                                    </button>
                                                    <input type="file" class="fileInput d-none">
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                </div>

                                <button type="button" class="btn btn-outline-primary mt-3" id="addWeekBtn">
                                    <i class="fas fa-plus me-2"></i>Add New Week
                                </button>
                            </div>

                            <!-- Course Media Section -->
                            <div class="form-section">
                                <h4><i class="fas fa-images me-2"></i>Course Media</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="courseThumbnail" class="form-label">Course Thumbnail</label>
                                        <div class="file-upload-box">
                                            <img src="" alt="Selected Thumbnail" class="img-fluid mb-3 rounded"
                                                id="thumbnailPreview">
                                            <input type="file" class="d-none" id="courseThumbnail" accept="image/*">
                                            <button class="btn btn-sm btn-outline-primary" type="button"
                                                onclick="document.getElementById('courseThumbnail').click()">
                                                <i class="fas fa-camera me-2"></i>Change Thumbnail
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="promoVideo" class="form-label">Preview Image</label>
                                        <div class="file-upload-box">
                                            <div class="ratio ratio-16x9 mb-3 bg-light rounded">
                                                <img src="resources/emptyImage.jpg" class="img-fluid rounded"
                                                    id="previewImage" />
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Save Controls -->
                                    <div class="d-flex justify-content-between mt-4">
                                        <div>
                                            <button type="submit" class="btn btn-save" onclick="saveThumbnail(event);">
                                                <i class="fas fa-save me-2"></i>Save Thumbnail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>

                    <!-- Empty State -->
                    <div class="text-center py-5" id="emptyState">
                        <i class="fas fa-book-open fa-4x text-muted mb-4"></i>
                        <h4>Select a Course to Edit</h4>
                        <p class="text-muted">Choose a course from the dropdown to begin editing</p>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#newCourseModal">
                            <i class="fas fa-plus me-2"></i>Create New Course
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Course Modal -->
        <div class="modal fade" id="newCourseModal" tabindex="-1" aria-labelledby="newCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="newCourseModalLabel">Create New Course</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="cname" class="form-label">Course Title</label>
                                <input type="text" class="form-control" id="cname" placeholder="Enter course title"
                                    required>
                            </div>
                            <div class="mb-3">
                                <?php
                                function generateRandomCode($length = 10)
                                {
                                    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                                    $randomString = '';

                                    for ($i = 0; $i < $length; $i++) {
                                        $index = random_int(0, strlen($characters) - 1);
                                        $randomString .= $characters[$index];
                                    }

                                    return $randomString;
                                }

                                ?>
                                <label for="cid" class="form-label">Course Id</label>
                                <input type="text" class="form-control" id="cid"
                                    value="<?php echo generateRandomCode(10); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="cfee" class="form-label">Course Fee</label>
                                <input type="text" class="form-control" id="cfee" placeholder="Enter course fee" required>
                            </div>
                            <div class="mb-3">
                                <label for="instructor" class="form-label">Instructor</label>
                                <select class="form-select" id="instructor">
                                    <option selected disabled>Select Instructor</option>
                                    <?php
                                    $rs = DataBase::search("SELECT * FROM `instructor`");
                                    $rows = $rs->num_rows;
                                    for ($x = 0; $x < $rows; $x++) {
                                        $data = $rs->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $data["id"]; ?>">
                                            <?php echo $data["firstname"] . " " . $data["lastname"]; ?>
                                        </option>
                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="registerCourse();">Create Course</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
        <script>
            // Course selection handler
            document.getElementById('courseSelect').addEventListener('change', function () {
                const selectedCourse = this.value;
                const editForm = document.getElementById('editForm');
                const emptyState = document.getElementById('emptyState');
                const courseStats = document.getElementById('courseStats');
                const instructorSection = document.getElementById('instructorSection');

                if (selectedCourse) {
                    // Show edit form and hide empty state
                    editForm.classList.remove('d-none');
                    emptyState.classList.add('d-none');
                    courseStats.classList.remove('d-none');
                    instructorSection.classList.remove('d-none');


                } else {
                    editForm.classList.add('d-none');
                    emptyState.classList.remove('d-none');
                    courseStats.classList.add('d-none');
                    instructorSection.classList.add('d-none');
                }
            });

            // Thumbnail preview handler
            document.getElementById('courseThumbnail').addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        document.getElementById('thumbnailPreview').src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Add new week handler
            document.getElementById('addWeekBtn').addEventListener('click', function () {
                const syllabusItems = document.getElementById('syllabusItems');

                const newWeek = document.createElement('div');
                newWeek.className = 'syllabus-item mb-4 border p-3 rounded';
                newWeek.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5>New Week</h5>
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addWeek(this);">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="mb-3">
            <label class="form-label">Week Title</label>
            <input type="text" class="form-control mb-2 weekTitle" placeholder="Enter week title">
            <label class="form-label">Description</label>
            <textarea class="form-control mb-2 weekDescription" rows="2" placeholder="Enter week description"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Video Lecture</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control videoLink" placeholder="Enter video URL">
                <button class="btn btn-outline-secondary file-btn" type="button">
                    <i class="fas fa-link"></i>
                </button>
                <input type="file" class="fileInput d-none">
            </div>
            
            
        </div>
        
    `;
                syllabusItems.insertBefore(newWeek, syllabusItems.firstChild);

                newWeek.scrollIntoView({ behavior: 'smooth' });
            });

            document.addEventListener("DOMContentLoaded", function () {
                // Select all copy buttons
                const copyButtons = document.querySelectorAll(".copy-btn");

                copyButtons.forEach(function (button) {
                    button.addEventListener("click", function () {
                        // Find the corresponding input field inside the same parent
                        const input = button.closest(".input-group").querySelector(".videoLink");
                        if (input && input.value.trim() !== "") {
                            navigator.clipboard.writeText(input.value.trim())
                                .then(() => {
                                    alert("Copied to clipboard!");
                                })
                                .catch(err => {
                                    console.error("Failed to copy:", err);
                                    alert("Failed to copy.");
                                });
                        } else {
                            alert("Input is empty!");
                        }
                    });
                });
            });



        </script>
    </body>

    </html>
    <!-- Design -->
    <?php

} else {
    header("Location: login.php");
    exit();
}
?>