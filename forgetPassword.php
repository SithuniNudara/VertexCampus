<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertex Institute - Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
        }

        .reset-container {
            max-width: 500px;
            margin-top: 50px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .reset-header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .reset-body {
            padding: 30px;
            background-color: white;
        }

        .form-control:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.25);
        }

        .btn-reset {
            background-color: #2c3e50;
            color: white;
            width: 100%;
        }

        .btn-reset:hover {
            background-color: #1a252f;
            color: white;
        }

        .institute-logo {
            width: 80px;
            margin-bottom: 15px;
        }

        .password-strength {
            height: 5px;
            margin-top: 5px;
            margin-bottom: 15px;
            background-color: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
        }

        .input-group-text {
            cursor: pointer;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e9ecef;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            font-weight: bold;
        }

        .step.active {
            background-color: #2c3e50;
            color: white;
        }

        .step.completed {
            background-color: #28a745;
            color: white;
        }

        .step-line {
            flex-grow: 1;
            height: 2px;
            background-color: #e9ecef;
            margin: 0 -5px;
            position: relative;
            top: 15px;
        }

        .step-line.active {
            background-color: #2c3e50;
        }

        .step-line.completed {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="reset-container mx-auto">
            <div class="reset-header">
                <img src="resources/logo.png" alt="Vertex Institute Logo" class="institute-logo rounded-circle">
                <h3>Vertex Institute of Advanced Technology</h3>
                <p class="mb-0">Reset Your Password</p>
            </div>
            <div class="reset-body">
                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step active" id="step1">1</div>
                    <div class="step-line" id="line1-2"></div>
                    <div class="step" id="step2">2</div>
                    <div class="step-line" id="line2-3"></div>
                    <div class="step" id="step3">3</div>
                </div>

                <!-- Step 1: Email Verification -->
                <div id="step1-content">
                    <form id="emailVerificationForm" onsubmit="forgetpassword(event);">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <small class="text-muted">Enter the email associated with your account</small>
                        </div>
                        <button type="submit" class="btn btn-reset">Send Verification Code</button>
                    </form>
                </div>

                <!-- Step 2: Code Verification -->
                <div id="step2-content" style="display: none;">
                    <form id="codeVerificationForm" onsubmit="verifyCode(event);">
                        <input type="hidden" id="verificationEmail" name="email">
                        <div class="mb-3">
                            <label for="code" class="form-label">Verification Code</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="code" name="code" required>
                                <button class="btn btn-outline-secondary" type="button" id="resendCodeBtn">Resend</button>
                            </div>
                            <small class="text-muted">Check your email for the 6-digit code</small>
                        </div>
                        <button type="submit" class="btn btn-reset">Verify Code</button>
                    </form>
                </div>

                <!-- Step 3: Password Reset -->
                <div id="step3-content" style="display: none;">
                    <form id="passwordResetForm" onsubmit="resetpassword(event);">
                        <input type="hidden" id="resetEmail" name="email">
                        <input type="hidden" id="resetCode" name="code">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                <span class="input-group-text toggle-password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <div class="password-strength">
                                <div class="password-strength-bar" id="passwordStrengthBar"></div>
                            </div>
                            <small class="text-muted">Minimum 8 characters with at least one number and special character</small>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <span class="input-group-text toggle-password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <div id="passwordMatch" class="text-danger small"></div>
                        </div>
                        <button type="submit" class="btn btn-reset">Reset Password</button>
                    </form>
                </div>

                <div class="text-center mt-3">
                    <a href="login.html" class="text-decoration-none">Back to Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        // Password strength indicator
        document.getElementById('new_password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            let strength = 0;
            
            // Length check
            if (password.length >= 8) strength += 25;
            if (password.length >= 12) strength += 25;
            
            // Character type checks
            if (/[A-Z]/.test(password)) strength += 15;
            if (/[0-9]/.test(password)) strength += 15;
            if (/[^A-Za-z0-9]/.test(password)) strength += 20;
            
            // Update strength bar
            strengthBar.style.width = strength + '%';
            
            // Update color
            if (strength < 50) {
                strengthBar.style.backgroundColor = '#dc3545'; // Red
            } else if (strength < 75) {
                strengthBar.style.backgroundColor = '#fd7e14'; // Orange
            } else {
                strengthBar.style.backgroundColor = '#28a745'; // Green
            }
        });

        // Password match checker
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('new_password').value;
            const confirmPassword = this.value;
            const matchIndicator = document.getElementById('passwordMatch');
            
            if (confirmPassword === '') {
                matchIndicator.textContent = '';
            } else if (password !== confirmPassword) {
                matchIndicator.textContent = 'Passwords do not match';
            } else {
                matchIndicator.textContent = 'Passwords match!';
                matchIndicator.className = 'text-success small';
            }
        });

        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });



        // document.getElementById('resendCodeBtn').addEventListener('click', function() {
        //     const email = document.getElementById('verificationEmail').value;
            
        //     // AJAX call to resend code
        //     var xhr = new XMLHttpRequest();
        //     xhr.open("POST", "send_reset_code.php", true);
        //     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //     xhr.onreadystatechange = function() {
        //         if (xhr.readyState === 4 && xhr.status === 200) {
        //             const response = JSON.parse(xhr.responseText);
        //             if (response.success) {
        //                 alert("New verification code sent");
        //                 startResendTimer();
        //             } else {
        //                 alert(response.message || "Failed to resend verification code");
        //             }
        //         }
        //     };
        //     xhr.send("email=" + encodeURIComponent(email));
        // });


    </script>
</body>
</html>