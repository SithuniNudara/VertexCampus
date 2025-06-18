<?php
session_start();

unset($_SESSION["user"]);
session_destroy();
// Clear cookies if they exist
if (isset($_COOKIE["remember"])) {
    setcookie("username", "", time() - 3600, "/");
    setcookie("password", "", time() - 3600, "/");
    setcookie("remember", "", time() - 3600, "/");
}
header("Location: login.php");


?>