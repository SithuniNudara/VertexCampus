<?php
include("connection.php");

$courseId = $_POST["courseID"];
$weekTitle = $_POST["title"];
$description = $_POST["description"];
$videoLink = $_POST["videolink"];

if (empty($courseId)) {
    echo "Course ID is empty";
} elseif (empty($weekTitle)) {
    echo "Add week title";
} elseif (empty($description)) {
    echo "Add description";
} elseif (empty($videoLink)) {
    echo "Add video link";
} else {
    $rs = DataBase::search("SELECT * FROM `course_content` WHERE `title`='$weekTitle' AND `course_id`='$courseId'");
    if ($rs->num_rows > 0) {
        echo "This week content already added";
    } else {
        DataBase::iud("INSERT INTO `course_content` (`course_id`,`title`,`description`,`video_link`) VALUES('$courseId','$weekTitle','$description','$videoLink')");
        echo "success";
    }
}
?>
