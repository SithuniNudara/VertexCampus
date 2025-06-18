<?php 
include "connection.php";
$code  = $_POST["code"];

if(empty($code)){
    echo "code is empty!";
}else{
    $rs = DataBase::search("SELECT * FROM `admin` WHERE `code` = '".$code."'");
    $rows = $rs->num_rows;
    if ($rows > 0) {
        echo "success";
    }else{
        echo "invalid";
    }
}
?>