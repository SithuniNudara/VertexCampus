<?php 

include("connection.php");

$courseId = $_POST['courseID'];
$courseName = $_POST['courseName'];
$courseFee = $_POST['courseFee'];
$instructorId = $_POST['instructor'];

if ($courseId == "") {
    echo "Please select a course";
} else if ($courseName == "") {
    echo "Please enter the course name";
} else if ($courseFee == "") {
    echo "Please enter the course fee";
} else if (!is_numeric($courseFee)) {
    echo "Course fee must be a numeric value";
} else if ($instructorId == "") {
    echo "Please select an instructor";
} else {

    $query = DataBase::search("SELECT * FROM `course` WHERE `course_name` = '" . $courseName . "' OR `id` = '" . $courseId . "'");
    $rows = $query->num_rows;

    if ($rows > 0) {
        echo "Course already exists";
    } else {
        DataBase::iud("INSERT INTO `course`(`id`, `course_name`, `course_fee`, `instructor`,`status_id`) VALUES ('" . $courseId . "','" . $courseName . "','" . $courseFee . "','" . $instructorId . "','1')");
        echo "success";
    }
}

?>