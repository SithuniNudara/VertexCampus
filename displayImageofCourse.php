<?php 
include "connection.php";

$courseID = $_GET["cid"];

$rs = DataBase::search("SELECT * FROM `course_thumbnail` WHERE `course_id` = '$courseID'");
$rows = $rs->num_rows;

if ($rows > 0) {
    $data = $rs->fetch_assoc();
    $image = $data["course_thumbnail"];
    echo $image;
}else{
    echo "resources/emptyImage.jpg";
}

?>