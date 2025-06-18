<?php

include "connection.php";

$firstname = $_POST["fname"];
$lastname = $_POST["lname"];
$username = $_POST["uname"];
$password = $_POST["pw"];
$email = $_POST["email"];
$img = $_FILES["img"];

// Validate input
if (empty($firstname)) {
    echo "Enter Firstname";
} else if (empty($lastname)) {
    echo "Enter Lastname";
} else if (empty($username)) {
    echo "Enter Username";
} else if (empty($password)) {
    echo "Enter Password";
} else if (empty($email)) {
    echo "Enter Email";
} elseif (strlen($email) > 100) {
    echo "Email should be less than 100 characters";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Your Email Address Is Invalid";
} else {
    // Check if user exists
    $rs = Database::search("SELECT * FROM `admin` WHERE `username` = '$username'");
    if ($rs->num_rows == 0) {
        echo "Username does not exist";
    } else {
        $file_name = null;

        // Handle image upload if provided
        if (isset($img) && $img["error"] == 0) {
            $allowed_types = ["image/jpg", "image/jpeg", "image/png", "image/svg+xml"];
            $file_type = $img["type"];

            if (in_array($file_type, $allowed_types)) {
                $ext = pathinfo($img["name"], PATHINFO_EXTENSION);
                $file_name = "profilepic/" . $username . "_" . uniqid() . "." . $ext;

                if (!move_uploaded_file($img["tmp_name"], $file_name)) {
                    echo "Image upload failed";
                    exit();
                }
            } else {
                echo "Not an Allowed Image Type";
                exit();
            }
        }

        // Build the update query
        $update_query = "UPDATE `admin` SET 
            `firstname` = '$firstname', 
            `lastname` = '$lastname', 
            `password` = '$password', 
            `email` = '$email'";

        if ($file_name !== null) {
            $update_query .= ", `image` = '$file_name'";
        }

        $update_query .= " WHERE `username` = '$username'";

        // Execute the update
        Database::iud($update_query);
        echo "Successfully Updated";
    }
}
?>
