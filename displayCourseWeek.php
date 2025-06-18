<?php 
include "connection.php";

$courseID = $_GET["cid"];

// Validate input
if (empty($courseID)) {
    echo json_encode(["error" => "Course ID is missing"]);
    exit;
}

$rs = DataBase::search("SELECT * FROM `course_content` WHERE `course_id` = '$courseID'");
$rows = $rs->num_rows;

if ($rows > 0) {
    $data = [];

    while ($row = $rs->fetch_assoc()) {
        $data[] = $row;
    }

    // Set header to JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo json_encode(["error" => "No content found for this course"]);
}
