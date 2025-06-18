<?php

include "connection.php";

$courseID = $_GET["cid"] ?? null;

if (empty($courseID)) {
    echo json_encode(["error" => "Course ID is missing"]);
    exit;
}


$rs = DataBase::search("SELECT `course`.`max_student` AS `maximum`, `status`.`status_name` AS `status` ,COUNT(`course_content`.`course_id`) AS `Number_of_Weeks`
    FROM `course`
    INNER JOIN `course_content` ON `course`.`id` = `course_content`.`course_id`
    INNER JOIN `status` ON `status`.`id` = `course`.`status_id`
    WHERE `course`.`id` = '".$courseID."'");

$rows = $rs->num_rows;

if ($rows > 0) {
    $data = $rs->fetch_assoc();

    echo json_encode($data);
} else {
    echo json_encode(["error" => "No details found for this course"]);
}

?>