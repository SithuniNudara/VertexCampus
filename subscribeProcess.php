<?php 

include "connection.php";

$email = $_GET["email"];
if (empty($email)) {
    echo "Email is required.";
}elseif(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    DataBase::iud("INSERT INTO newsletter (`email`) VALUES ('$email')");
    echo "success";  
} else {
    echo "Invalid email format.";
}

?>