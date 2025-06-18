<?php
include "connection.php";

$search = trim($_POST["search"]);


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
WHERE `course_name` LIKE '%" . $search . "%'
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
                        <img src="<?php echo $data["course_thumbnail"]; ?>" class="card-img-top" alt="Course Thumbnail">
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
                            
                            <a class="btn btn-sm btn-primary" onclick="singleCourseView('<?php echo $courseID;?>')">View Course</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    }

?>