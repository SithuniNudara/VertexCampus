<?php 

include ("connection.php");

$nic = $_GET["nic"];

$rs = DataBase::search(" SELECT * FROM `student` WHERE `nic` = '".$nic."' ");
$rows = $rs->num_rows;

if($rows > 0){
    DataBase::iud("DELETE FROM `student` WHERE `nic` = '".$nic."' ");
    echo "success";
}else{
    echo "Invalid NIC";
}

?>