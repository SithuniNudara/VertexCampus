<?php

session_start();

$username = $_POST["username"];
$password = $_POST["password"];
$remember = $_POST["remember"];

if (empty($username)) {
    echo "Username is required";
} elseif (empty($password)) {
    echo "Password is required";
} elseif (strlen($password) > 100) {
    echo "Password is too long";
} else {
    $con = mysqli_connect("localhost", "root", "1234", "vertex");

    $sql = "SELECT * FROM `admin` WHERE `username`='" . $username . "' AND `password` ='".$password."'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {

        $_SESSION["user"] = $result->fetch_assoc();
        $_SESSION["user"]["username"] = $username; 
        $_SESSION["user"]["password"] = $password; 

        if ($remember) {
            setcookie("username", $username, time() + (86400 * 30)); //1month
            setcookie("password", $password, time() + (86400 * 30));
            setcookie("remember", "true", time() + (86400 * 30));
        } else {
            setcookie("username", "", -1);
            setcookie("password", "", -1);
            setcookie("remember", "", -1);
        }

        echo "success";
    } else {
        echo "Invalid username or password";
    }

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
}

?>