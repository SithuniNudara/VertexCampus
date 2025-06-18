<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertex Institute - All Courses</title>
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

        .course-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            margin-bottom: 25px;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .course-card .card-img-top {
            height: 180px;
            object-fit: cover;
        }

        .course-card .card-body {
            padding: 20px;
        }

        .badge-popular {
            background-color: #e74c3c;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .course-category {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(52, 152, 219, 0.9);
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .filter-section {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .instructor-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Vertex Institute of Advanced Technology</h2>
                    <p class="mb-0">Course Catalog</p>
                </div>
                <img src="resources/logo.png" alt="Institute Logo" class="rounded-circle" width="60">
            </div>
        </div>
    </div>

    <div class="container">

        <div class="filter-section">
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="courseSearch" class="form-label">Search Courses</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="courseSearch" placeholder="Search by course name"
                            onkeyup="searchbyTyping(event);">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="departmentFilter" class="form-label">Courses</label>
                    <select class="form-select" id="departmentFilter" onchange="changeCourseSearch(event);">
                        <option value="" selected disabled>Select</option>
                        <?php
                        $rs = DataBase::search("SELECT * FROM `course`");
                        $rows = $rs->num_rows;
                        for ($x = 0; $x < $rows; $x++) {
                            $data = $rs->fetch_assoc();
                            echo "<option value='" . $data["id"] . "'>" . $data["course_name"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="levelFilter" class="form-label">Instructor</label>
                    <select class="form-select" id="levelFilter" onchange="changeInstructorSearch(event);">
                        <option value="" selected disabled>Select</option>
                        <?php

                        $rs = DataBase::search("SELECT * FROM `instructor`");
                        $rows = $rs->num_rows;
                        for ($x = 0; $x < $rows; $x++) {
                            $data = $rs->fetch_assoc();
                            echo "<option value='" . $data["id"] . "'>" . $data["firstname"] . " " . $data["lastname"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

        </div>

        <!-- Courses Grid -->
        <div class="row mb-3">
            <div class="row mb-3" id="courseContent">
                <?php
                $rs = DataBase::search("SELECT DISTINCT
        course.id AS course_id,
        course.course_name,
        course.course_description,
        course.max_student,
        course_thumbnail.course_thumbnail AS course_thumbnail,
        status.status_name AS status_name,
        instructor.firstname,
        instructor.lastname,
        instructor.image_path
    FROM course
    INNER JOIN status ON status.id = course.status_id
    INNER JOIN course_thumbnail ON course.id = course_thumbnail.course_id
    INNER JOIN instructor ON instructor.id = course.instructor
    ORDER BY course.course_name DESC");

                $rows = $rs->num_rows;

                if ($rows > 0) {
                    for ($i = 0; $i < $rows; $i++) {
                        $data = $rs->fetch_assoc();
                        $courseID = $data["course_id"];
                        ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="course-card card d-flex">
                                <div class="position-relative">
                                    <img src="<?php echo $data["course_thumbnail"]; ?>" class="card-img-top"
                                        alt="Course Thumbnail">
                                    <span class="badge badge-popular rounded-pill">
                                        <i class="fas fa-fire me-1"></i> Popular
                                    </span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data["course_name"]; ?></h5>
                                    <p class="card-text text-muted"><?php echo $data["course_description"]; ?></p>
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="<?php echo $data["image_path"]; ?>" alt="Instructor" class="instructor-img">
                                        <div>
                                            <h6 class="mb-0"><?php echo $data["firstname"] . " " . $data["lastname"]; ?></h6>
                                            <small class="text-muted"><?php echo $data["course_name"]; ?></small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge bg-light text-dark me-2">
                                                <i class="fas fa-users me-1"></i> <?php echo $data["max_student"]; ?>
                                            </span>
                                            <span class="badge bg-light text-dark">
                                                <i class="fas fa-star text-warning me-1"></i>
                                                <?php echo $data["status_name"]; ?>
                                            </span>
                                        </div>
                                        <a class="btn btn-sm btn-primary" href="#" onclick="window.location.href='singleCourseView.php?cid=<?php echo $courseID; ?>'">View Course</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>


        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>

</html>