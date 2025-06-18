<?php

include("connection.php");

$cid = $_GET["cid"];

$rs = DataBase::search("SELECT `course_fee`,`max_student`,`discount` FROM `course` WHERE `id` = '" . $cid . "'");

$rows = $rs->num_rows;
if ($rows > 0) {
    $data = $rs->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(["error" => "Course not found"]);
}

?>
