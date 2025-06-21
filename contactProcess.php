<?php 

include("connection.php");

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

if(empty($name)){
    echo "Name is required.";
} elseif(empty($email)) {
    echo "Email is required.";
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
} elseif(empty($subject)) {
    echo "Subject is required.";
} elseif(empty($message)) {
    echo "Message is required.";
} else {
    $date = date("Y-m-d");
    DataBase::iud("INSERT INTO `messages` (`name`, `email`, `subject`, `message`,`added_time`) VALUES ('$name', '$email', '$subject', '$message','$date')");
    echo "success";
}

?>