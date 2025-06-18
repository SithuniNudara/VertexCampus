<?php
header("Content-Type: text/plain");
include("connection.php");

$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$nic = trim($_POST['nic']);
$gender = trim($_POST['gender']);
$dob = trim($_POST['dob']);
$address = trim($_POST['address']);
$mobile = trim($_POST['mobile']);
$email = trim($_POST['email']);
$course = trim($_POST['courseID']);
$intake = trim($_POST['intake']);

if ($firstName == "") {
    echo "First name is required.";
} elseif ($lastName == "") {
    echo "Last name is required.";
} elseif ($nic == "") {
    echo "NIC is required.";
} elseif ($gender == "") {
    echo "Select Gender.";
} elseif ($dob == "") {
    echo "Date of Birth is required.";
} elseif ($address == "") {
    echo "Address is required.";
} else if ($mobile == "") {
    echo "Please enter your mobile number";
} elseif (strlen($mobile) != 10) {
    echo ("Please Enter Valid Mobile Number");
} elseif (!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/", $mobile)) {
    echo ("Invalid Mobile Number");
} else if (empty($email)) {
    echo ("Please Enter Your Email Address");
} elseif (strlen($email) > 100) {
    echo ("Email should be less than 100 characters");
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Your Email Address Is Invalid");
} elseif ($course == "") {
    echo "Course is required.";
} elseif ($intake == "") {
    echo "Intake is required.";
} else {
    $rs = DataBase::search("SELECT * FROM `student` WHERE `nic` = '$nic' OR `email` = '$email' OR `mobile`= '$mobile'");
    $rows = $rs->num_rows;
    if ($rows > 0) {
        echo "Student with this NIC already exists.";
    } else {
        DataBase::iud("INSERT INTO `student` (`firstname`, `lastname`, `nic`, `gender_id`, `dob`, `address`, `mobile`, `email`, `course_id`, `intake_id`) VALUES ('$firstName', '$lastName','$nic', '$gender', '$dob', '$address', '$mobile', '$email', '$course', '$intake')");
        echo "success";
    }
}
?>