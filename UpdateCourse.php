<?php
include("connection.php");

$cid = $_POST["id"];
$cname = $_POST["name"];
$des = $_POST["des"];
$fee = $_POST["fee"];
$instructor = $_POST["ins"];

// Basic validation
if (empty($cname)) {
    echo "Please add course name";
} elseif (empty($des)) {
    echo "Please enter the course description";
} elseif (empty($fee)) {
    echo "Please enter the course fee";
} else {

    $coursers = DataBase::search("SELECT `course_name` FROM `course` WHERE `id` = '$cid'");

    if ($coursers->num_rows > 0) {
        $row = $coursers->fetch_assoc();
        $current_name = $row["course_name"];

        // Update only fee and description if the course name is unchanged
        if ($current_name == $cname) {
            DataBase::iud("UPDATE `course` SET  `course_description`= '".$des."' WHERE `id`='$cid'");
        } else {
            DataBase::iud("UPDATE `course` SET `course_name`= '$cname',  `course_description`= '".$des."'  WHERE `id`='$cid'");
        }
        echo "success";
    } else {
        echo "Course not found";
    }
}
?>