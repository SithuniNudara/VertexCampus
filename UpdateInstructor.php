<?php 
include("connection.php");

if(isset($_POST["id"] ) || isset($_POST["cid"])){
    $instructor = $_POST["id"];
    $cid = $_POST["cid"];

    DataBase::iud("UPDATE `course` SET `instructor` = '".$instructor."' WHERE `id` = '".$cid."'");
    echo "success";
}else{
    echo "Error";
}
?>