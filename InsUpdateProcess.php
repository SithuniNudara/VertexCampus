<?php
include("connection.php");

$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$gender = $_POST["gender"];
$fees = $_POST['fee'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];

if ($firstName == "") {
    echo "Please enter your first name";
} else if ($lastName == "") {
    echo "Please enter your last name";
} else if ($gender == "") {
    echo "Please Select your gender";
} else if ($fees == "") {
    echo "Please enter your fees";
} else if (!is_numeric($fees)) {
    echo "Fees must be a numeric value";
} else if ($dob == "") {
    echo "Please enter your date of birth";
} else if ($address == "") {
    echo "Please enter your address";
} else {

    $query = DataBase::search("SELECT * FROM `instructor` WHERE `email` = '" . $email . "' OR `mobile` = '" . $mobile . "'");
    $rows = $query->num_rows;

    if ($rows == 0) {

        echo "Istructor with this email or mobile number does not exist. Please check your details.";

    } else {

        DataBase::iud("UPDATE `instructor` SET `firstname` = '$firstName', `lastname`= '$lastName', `gender_id`= '$gender', `fees`='$fees', `dob`='$dob', `address`='$address' WHERE `email` = '" . $email . "' OR `mobile` = '" . $mobile . "'");
        echo "success";

    }
}


?>