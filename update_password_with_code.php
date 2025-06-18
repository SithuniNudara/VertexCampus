<?php
include "connection.php";

$email = trim($_POST['email']);
$code = trim($_POST['code']);
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];

if ($newPassword !== $confirmPassword) {
    echo "Passwords do not match!";
    exit();
}

// Check if code matches
$result = DataBase::search("SELECT * FROM admin WHERE email = '$email' AND code = '$code'");
if ($result->num_rows === 0) {
    echo "Invalid email or code!";
    exit();
}

// Hash the new password
$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

// Update password and clear the code
DataBase::iud("UPDATE admin SET password = '$hashedPassword', code = NULL WHERE email = '$email'");

echo "Password updated successfully!";
?>
