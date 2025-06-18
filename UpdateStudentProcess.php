<?php

include("connection.php");

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$nic = $_POST['nic'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$course = $_POST['courseID'];
$intake = $_POST['intake'];

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
    if ($rows == 0) {
        echo "No student found with this NIC.";
    } else {
        DataBase::iud("UPDATE `student` SET `firstname` = '$firstName', `lastname` = '$lastName', `gender_id` = '$gender', `dob` = '$dob', `address` = '$address', `course_id` = '$course', `intake_id` = '$intake' WHERE `nic` = '$nic'");
        echo "success";
    }

}

?>