<?php 

include ("connection.php");

$course_id = $_POST["cid"];
$course_fee = $_POST["fee"];
$maxCount = $_POST["mcount"];
$discount = $_POST["dis"];

if(empty($course_id)){
    echo "Course Id is Empty";
}elseif (empty($course_fee)) {
    echo "Course Fee is Requied";
}elseif (empty($maxCount)) {
    echo "Max Count Should Addedd";
}elseif (empty($discount) OR $discount == 0) {
    $discount = 0;
}else{
    DataBase::iud("UPDATE `course` SET `course_fee` = '".$course_fee."', `max_student` = '".$maxCount."', `discount`= '".$discount."'  WHERE `id`= '".$course_id."'");
    echo ("success");
}

?>