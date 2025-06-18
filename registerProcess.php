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
} else {

    $query = DataBase::search("SELECT * FROM `instructor` WHERE `email` = '" . $email . "' OR `mobile` = '" . $mobile . "'");
    $rows = $query->num_rows;

    if ($rows > 0) {

        echo "Email or Mobile Number already exists";

    } else {


        function generateRandomCode($length = 10)
        {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $index = random_int(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }

            return $randomString;
        }


        $id = generateRandomCode(10);
        DataBase::iud("INSERT INTO `instructor`(`id`,`firstname`, `lastname`, `gender_id`, `fees`, `dob`, `address`, `mobile`, `email`) VALUES ('" . $id . "','" . $firstName . "','" . $lastName . "','" . $gender . "','" . $fees . "','" . $dob . "','" . $address . "','" . $mobile . "','" . $email . "')");
        echo "success";

    }
}


?>