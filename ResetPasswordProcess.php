<?php 
include "connection.php";
$code = trim($_POST["c"]);
$newPassword = $_POST["np"];
$confimPassword = $_POST["cp"];

if (empty($newPassword)) {
    echo "Password Is Empty";
}elseif (empty($confimPassword)) {
    echo "re enter password";
}elseif (!$newPassword == $confimPassword) {
    echo "New password and Confirm Passowrd mismatch";
}else{
    $rs = DataBase::search("SELECT * FROM `admin` WHERE `code` = '$code'");
    $rows = $rs->num_rows;
    if ($rows > 0) {
        DataBase::iud("UPDATE `admin` SET `password` = '".$confimPassword."' ");
        echo "success";
    }else{
        echo "invalid user";
    }
}

?>