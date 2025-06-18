<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<h2>Reset Your Password</h2>
<form method="POST" action="update_password_with_code.php">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Reset Code</label><br>
    <input type="text" name="code" required><br><br>

    <label>New Password</label><br>
    <input type="password" name="new_password" required><br><br>

    <label>Confirm Password</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <input type="submit" value="Reset Password">
</form>
</body>
</html>
