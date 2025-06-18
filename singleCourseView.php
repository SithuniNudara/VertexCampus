<?php

include "connection.php";

$courseId = $_GET["cid"];

$rs = DataBase::search("SELECT * FROM `course` INNER JOIN `course_content` ON `course`.`id` = `course_content`.`course_id` WHERE `course`.`id` = '" . $courseId . "' ");
$data = $rs->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["course_name"]; ?> | Vertex Institute</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .course-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://source.unsplash.com/random/1200x400/?machine,learning');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
            margin-bottom: 30px;
        }

        .course-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .course-sidebar {
            background-color: #f8f9fa;
            padding: 20px;
            height: 100%;
        }

        .instructor-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .instructor-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto;
            border: 3px solid white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .lesson-item {
            border-left: 3px solid var(--secondary-color);
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .lesson-item:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }

        .lesson-item.active {
            background-color: #e3f2fd;
            border-left: 3px solid var(--primary-color);
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .course-meta {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .course-meta i {
            width: 25px;
            color: var(--secondary-color);
        }

        .rating-stars {
            color: #f8d64e;
            margin-right: 5px;
        }

        .feedback-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .related-course-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            margin-bottom: 20px;
        }

        .related-course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-enroll {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 50px;
        }

        .btn-enroll:hover {
            background-color: #2980b9;
            color: white;
        }

        .progress-bar {
            background-color: var(--secondary-color);
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(52, 152, 219, 0.1);
            color: var(--primary-color);
        }
    </style>
</head>

<body>
    <!-- Course Hero Section -->
    <div class="course-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <?php

                    $Countrs = DataBase::search("SELECT COUNT(course_content.title) AS `count`
FROM course
INNER JOIN course_content ON course.id = course_content.course_id
WHERE course.id = '" . $courseId . "'");
                    $countdata = $Countrs->fetch_assoc();

                    ?>
                    <span class="badge bg-light text-primary mb-3"><?php echo "Information Technology Course"; ?></span>
                    <h1 class="display-4 mb-3"><?php echo $data["course_name"]; ?></h1>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-star rating-stars"></i> 4.8 (1,240 reviews)
                        </span>
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-users me-1"></i> <?php echo $data["max_student"]; ?> students
                        </span>
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-clock me-1"></i><?php echo $countdata["count"] ?> weeks
                        </span>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <button class="btn btn-enroll btn-lg">
                        <i class="fas fa-shopping-cart me-2"></i> Enroll Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Main Course Content -->
            <div class="col-lg-8">
                <div class="course-container mb-4">
                    <div class="p-4">
                        <h3 class="mb-4"><i class="fas fa-play-circle text-primary me-2"></i>Course Content</h3>

                        <!-- Video Player -->
                        <div class="video-container mb-4">
                            <iframe id="courseVideo" src="<?php echo $data["video_link"]; ?>"
                                allowfullscreen></iframe>
                        </div>

                        <!-- Current Lesson Info -->
                        <div class="alert alert-info mb-4">
                            <h5 id="currentLessonTitle">Introduction to <?php echo $data["course_name"]; ?></h5>
                            <p class="mb-0" id="currentLessonDesc">Overview of <?php echo $data["course_name"]; ?>
                                concepts and
                                applications in various industries.</p>
                        </div>

                        <!-- Course Description -->
                        <div class="mb-5">
                            <h4 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i>About This Course</h4>
                            <p><?php echo $data["course_description"]; ?></p>
                        </div>

                        <!-- Lessons Accordion -->
                        <div class="accordion mb-4" id="lessonsAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne">
                                        <i class="fas fa-list-ul me-2"></i> Course Syllabus
                                        (<?php echo $countdata["count"] ?> Week)
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#lessonsAccordion">
                                    <div class="accordion-body p-0">
                                        <div id="lessonsList">
                                            <?php
                                            $rs = DataBase::search("SELECT *
FROM course
INNER JOIN course_content ON course.id = course_content.course_id
WHERE course.id = '".$courseId."'");
                                            $rows = $rs->num_rows;

                                            for ($i = 0; $i < $rows; $i++) {
                                                $data = $rs->fetch_assoc();
                                                ?>
                                                <!-- Design -->
                                                <div class="lesson-item active"
                                                    data-video="<?php echo $data["video_link"] ?>"
                                                    data-title="<?php echo $data["title"] ?>"
                                                    data-desc="<?php echo $data["description"] ?>">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h5 class="mb-1"><?php echo $data["title"] ?></h5>
                                                        </div>
                                                        <i class="fas fa-play-circle text-primary"></i>
                                                    </div>
                                                </div>
                                                <!-- Design -->
                                                <?php
                                            }

                                            ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- What You'll Learn -->
                        <div class="mb-5">
                            <h4 class="mb-3"><i class="fas fa-check-circle text-success me-2"></i>What You'll Learn</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush mb-4">
                                        <li class="list-group-item ps-0 border-0"><i
                                                class="fas fa-check text-success me-2"></i>Fundamentals of
                                            <?php echo $data["course_name"]; ?>
                                        </li>
                                        <li class="list-group-item ps-0 border-0"><i
                                                class="fas fa-check text-success me-2"></i>Supervised vs unsupervised
                                            learning</li>
                                        <li class="list-group-item ps-0 border-0"><i
                                                class="fas fa-check text-success me-2"></i>Regression and classification
                                            algorithms</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush mb-4">
                                        <li class="list-group-item ps-0 border-0"><i
                                                class="fas fa-check text-success me-2"></i>Neural networks basics</li>
                                        <li class="list-group-item ps-0 border-0"><i
                                                class="fas fa-check text-success me-2"></i>Model evaluation techniques
                                        </li>
                                        <li class="list-group-item ps-0 border-0"><i
                                                class="fas fa-check text-success me-2"></i>Real-world project
                                            implementation</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Requirements -->
                        <div class="mb-5">
                            <h4 class="mb-3"><i class="fas fa-tools text-primary me-2"></i>Requirements</h4>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item ps-0 border-0"><i
                                        class="fas fa-check-circle text-success me-2"></i>Basic knowledge of
                                    <?php echo $data["course_name"]; ?>
                                </li>
                                <li class="list-group-item ps-0 border-0"><i
                                        class="fas fa-check-circle text-success me-2"></i>High school level mathematics
                                </li>
                                <li class="list-group-item ps-0 border-0"><i
                                        class="fas fa-check-circle text-success me-2"></i>No prior machine learning
                                    experience required</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Feedback Section -->
                <div class="course-container mb-4">
                    <div class="p-4">
                        <h3 class="mb-4"><i class="fas fa-comments text-primary me-2"></i>Student Feedback</h3>

                        <!-- Rating Summary -->
                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                <h1 class="display-4 mb-0">4.8</h1>
                                <div class="mb-2">
                                    <i class="fas fa-star rating-stars"></i>
                                    <i class="fas fa-star rating-stars"></i>
                                    <i class="fas fa-star rating-stars"></i>
                                    <i class="fas fa-star rating-stars"></i>
                                    <i class="fas fa-star-half-alt rating-stars"></i>
                                </div>
                                <p class="text-muted">Course Rating</p>
                            </div>
                            <div class="col-md-9">
                                <div class="mb-2">
                                    <span class="me-2">5 <i class="fas fa-star rating-stars"></i></span>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 85%"></div>
                                    </div>
                                    <span class="ms-2">85%</span>
                                </div>
                                <div class="mb-2">
                                    <span class="me-2">4 <i class="fas fa-star rating-stars"></i></span>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 12%"></div>
                                    </div>
                                    <span class="ms-2">12%</span>
                                </div>
                                <div class="mb-2">
                                    <span class="me-2">3 <i class="fas fa-star rating-stars"></i></span>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 2%"></div>
                                    </div>
                                    <span class="ms-2">2%</span>
                                </div>
                                <div class="mb-2">
                                    <span class="me-2">2 <i class="fas fa-star rating-stars"></i></span>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 1%"></div>
                                    </div>
                                    <span class="ms-2">1%</span>
                                </div>
                                <div class="mb-2">
                                    <span class="me-2">1 <i class="fas fa-star rating-stars"></i></span>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 0%"></div>
                                    </div>
                                    <span class="ms-2">0%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews -->
                        <div class="mb-4">
                            <div class="feedback-card card mb-3">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Student"
                                            class="rounded-circle me-3" width="50" height="50">
                                        <div>
                                            <h6 class="mb-0">Sarah Johnson</h6>
                                            <div class="mb-1">
                                                <i class="fas fa-star rating-stars"></i>
                                                <i class="fas fa-star rating-stars"></i>
                                                <i class="fas fa-star rating-stars"></i>
                                                <i class="fas fa-star rating-stars"></i>
                                                <i class="fas fa-star rating-stars"></i>
                                            </div>
                                            <small class="text-muted">Completed on Jan 15, 2023</small>
                                        </div>
                                    </div>
                                    <p class="card-text">This course gave me a solid foundation in machine learning. The
                                        hands-on projects were especially valuable for applying the concepts in
                                        real-world scenarios. Dr. Chen explains complex topics in a way that's easy to
                                        understand.</p>
                                </div>
                            </div>

                            <div class="feedback-card card mb-3">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Student"
                                            class="rounded-circle me-3" width="50" height="50">
                                        <div>
                                            <h6 class="mb-0">Michael Chen</h6>
                                            <div class="mb-1">
                                                <i class="fas fa-star rating-stars"></i>
                                                <i class="fas fa-star rating-stars"></i>
                                                <i class="fas fa-star rating-stars"></i>
                                                <i class="fas fa-star rating-stars"></i>
                                                <i class="fas fa-star-half-alt rating-stars"></i>
                                            </div>
                                            <small class="text-muted">Completed on Dec 5, 2022</small>
                                        </div>
                                    </div>
                                    <p class="card-text">Excellent course content and well-structured. The only reason
                                        I'm not giving 5 stars is that some of the later Python implementations could
                                        use more detailed explanations for beginners.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Instructor Card -->
                <div class="course-container mb-4">
                    <div class="p-4">
                        <?php
                        $rs = DataBase::search("SELECT * FROM `course` INNER JOIN `instructor` ON `course`.`instructor` = `instructor`.`id` WHERE `course`.`id` = '$courseId' ");
                        $data3 = $rs->fetch_assoc();

                        ?>
                        <h4 class="mb-3"><i class="fas fa-chalkboard-teacher text-primary me-2"></i>Instructor</h4>
                        <div class="instructor-card card">
                            <div class="card-body text-center">
                                <img src="<?php echo $data3["image_path"]; ?>" alt="Instructor"
                                    class="instructor-img mb-3">
                                <h4></h4>
                                <p class="text-muted"><?php echo $data3["course_name"]; ?> Instructor</p>
                                <p class="mb-3">PhD in Computer Science with 12+ years of experience in
                                    <?php echo $data3["course_name"]; ?>
                                    and <?php echo $data3["course_name"]; ?> research.
                                </p>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-globe"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Details -->
                <div class="course-container mb-4">
                    <div class="p-4">
                        <h4 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Course Details</h4>
                        <div class="course-meta">
                            <i class="fas fa-film"></i>
                            <div>
                                <h6 class="mb-0">Course Format</h6>
                                <p class="mb-0 text-muted">Video Lectures</p>
                            </div>
                        </div>
                        <div class="course-meta">
                            <i class="fas fa-tachometer-alt"></i>
                            <div>
                                <h6 class="mb-0">Difficulty Level</h6>
                                <p class="mb-0 text-muted">Intermediate</p>
                            </div>
                        </div>
                        <div class="course-meta">
                            <i class="fas fa-language"></i>
                            <div>
                                <h6 class="mb-0">Language</h6>
                                <p class="mb-0 text-muted">English</p>
                            </div>
                        </div>
                        <div class="course-meta">
                            <i class="fas fa-closed-captioning"></i>
                            <div>
                                <h6 class="mb-0">Subtitles</h6>
                                <p class="mb-0 text-muted">English, Spanish</p>
                            </div>
                        </div>
                        <div class="course-meta">
                            <i class="fas fa-certificate"></i>
                            <div>
                                <h6 class="mb-0">Certificate</h6>
                                <p class="mb-0 text-muted">Included</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Courses -->
                <div class="course-container">

                    <div class="p-4">

                        <h4 class="mb-3"><i class="fas fa-book text-primary me-2"></i>Related Courses</h4>

                        <?php
                        $rs = DataBase::search("SELECT * FROM `course` INNER JOIN `course_thumbnail` ON `course`.`id` = `course_thumbnail`.`course_id` ORDER BY `course`.`course_name` ASC LIMIT 3");
                        $rows = $rs->num_rows;
                        if ($rows > 0) {
                            for ($i = 0; $i < $rows; $i++) {
                                $data = $rs->fetch_assoc();
                                $courseID = $data["id"];
                                ?>
                                <!-- Design Start -->
                                <div class="related-course-card card">
                                    <img src="<?php echo $data["course_thumbnail"]; ?>" class="card-img-top" alt="Data Science">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $data["course_name"]; ?></h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-light text-dark">
                                                <i class="fa fa-users" aria-hidden="true"></i>Maximum Student Count:
                                                <?php echo $data["max_student"]; ?>
                                            </span>
                                            <a class="btn btn-sm btn-primary" href="#"
                                                onclick="window.location.href='singleCourseView.php?cid=<?php echo $courseID; ?>'">View
                                                Course</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Design End -->
                                <?php
                            }
                        }
                        ?>
                        <a class="btn btn-outline-primary" href="viewAllCourses.php">View All Courses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Lesson item click handler
        document.querySelectorAll('.lesson-item').forEach(item => {
            item.addEventListener('click', function () {
                // Update active lesson
                document.querySelectorAll('.lesson-item').forEach(i => {
                    i.classList.remove('active');
                });
                this.classList.add('active');

                // Update video
                const videoUrl = this.getAttribute('data-video');
                document.getElementById('courseVideo').src = videoUrl;

                // Update lesson info
                document.getElementById('currentLessonTitle').textContent = this.getAttribute('data-title');
                document.getElementById('currentLessonDesc').textContent = this.getAttribute('data-desc');
            });
        });

        // Star rating interaction
        document.querySelectorAll('.rating i').forEach(star => {
            star.addEventListener('click', function () {
                const rating = parseInt(this.getAttribute('data-rating'));
                const stars = document.querySelectorAll('.rating i');

                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.remove('far');
                        s.classList.add('fas');
                    } else {
                        s.classList.remove('fas');
                        s.classList.add('far');
                    }
                });
            });
        });

        // Sample enrollment functionality
        document.querySelector('.btn-enroll').addEventListener('click', function () {
            alert('You are being redirected to the enrollment page');
            // In a real implementation, this would redirect to checkout or enrollment process
        });
    </script>
</body>

</html>