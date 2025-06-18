<?php
session_start();
include("connection.php");
if (!isset($_SESSION["user"])) {
    
    header("Location: login.php");
} else {
    $user = $_SESSION["user"];
    ?>
    <!-- Design -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Profile</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .profile-card {
                border-radius: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .profile-img {
                width: 150px;
                height: 150px;
                object-fit: cover;
                border: 5px solid white;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .profile-header {
                background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                color: white;
                border-radius: 15px 15px 0 0;
                padding: 20px;
            }

            .profile-body {
                padding: 30px;
            }

            .info-label {
                font-weight: 600;
                color: #6c757d;
            }

            .info-value {
                font-size: 1.1rem;
            }

            .btn-edit {
                background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                border: none;
            }

            .btn-edit:hover {
                opacity: 0.9;
            }
        </style>
    </head>

    <body>
        <?php include "navbar.php"; ?>
        <div class="container py-5">
            <?php 
            $rs = DataBase::search("SELECT * FROM `admin` WHERE `username` = '".$user["username"]."' AND `password` = '".$user["password"]."'");
            $data = $rs->fetch_assoc();

            ?>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="profile-card bg-white">
                        <div class="profile-header text-center">
                            <img src="<?php echo $data["image"];?>" alt="Profile Image"
                                class="profile-img rounded-circle mb-3">
                            <h3><?php echo $data["firstname"]." ".$data["lastname"];?></h3>
                            <p class="mb-0">Administrator</p>
                        </div>
                        <div class="profile-body">
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <p class="info-label mb-1">First Name</p>
                                    <p class="info-value"><?php echo $data["firstname"];?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="info-label mb-1">Last Name</p>
                                    <p class="info-value"><?php echo $data["lastname"];?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="info-label mb-1">Username</p>
                                    <p class="info-value"><?php echo $data["username"];?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="info-label mb-1">Password</p>
                                    <p class="info-value"><?php echo $data["password"];?></p>
                                </div>
                                <div class="col-12 mb-3">
                                    <p class="info-label mb-1">Email</p>
                                    <p class="info-value"><?php echo $data["email"];?></p>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-edit text-white px-4 py-2 rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#editProfileModal">
                                    <i class="fas fa-edit me-2"></i>Update Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="editProfileModalLabel">Update Profile</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" value="<?php echo $data["firstname"];?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" value="<?php echo $data["lastname"];?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" value="<?php echo $data["username"];?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" value="<?php echo $data["password"];?>">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo $data["email"];?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="profileImage" class="form-label">Profile Image</label>
                                    <input class="form-control" type="file" id="profileImage">
                                    <div class="form-text">Upload a new profile image (JPEG, PNG, max 2MB)</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="updateAdminProfile(event)">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
        <script>
            // Toggle password visibility
            document.getElementById('togglePassword').addEventListener('click', function () {
                const passwordInput = document.getElementById('password');
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        </script>
    </body>

    </html>
    <!--  -->
    <?php
}

?>