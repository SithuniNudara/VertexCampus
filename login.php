<?php

include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertex Institute - Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
        }

        .login-container {
            max-width: 400px;
            margin-top: 100px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .login-header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .login-body {
            padding: 30px;
            background-color: white;
        }

        .form-control:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.25);
        }

        .btn-login {
            background-color: #2c3e50;
            color: white;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #1a252f;
            color: white;
        }

        .institute-logo {
            width: 80px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container mx-auto">
            <div class="login-header">
                <img src="resources/logo.png" alt="Vertex Institute Logo" class="institute-logo rounded-circle">
                <h3>Vertex Institute of Advanced Technology</h3>
                <p class="mb-0">Administrator Login</p>
            </div>
            <div class="login-body">

                <?php
                $username = "";
                $password = "";
                $remember = false;

                if ($_COOKIE["remember"]) {
                    $username = $_COOKIE["username"];
                    $password = $_COOKIE["password"];

                }

                ?>

                <form id="loginForm">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter your username" required
                            value="<?php echo $username; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password"
                            required value="<?php echo $password; ?>">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe" <?php echo "checked"; ?>>
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-login" onclick="login(event)">Login</button>
                    <div class="text-center mt-3">
                        <a href="forgetPassword.php" class="text-decoration-none">Forgot password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <!-- <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="forgotPasswordForm" onsubmit="forgetpassword(event);">
                    <div class="modal-header">
                        <h5 class="modal-title">Forgot Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="forgotEmail" class="form-label">Enter your email</label>
                        <input type="email" class="form-control" id="forgotEmail" name="email" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Send Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <!-- Reset Password Modal -->
    <!-- <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="resetPasswordForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="resetEmail" name="email">
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>