<?php

include("connection.php");
if (!isset($_GET["nic"])) {
    header("Location: searchStudent.php");
    exit();
} else {
    $nic = $_GET['nic'];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vertex Institute - Student Registration</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .header {
                background-color: #2c3e50;
                color: white;
                padding: 20px 0;
                margin-bottom: 30px;
            }

            .registration-container {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                padding: 30px;
                margin-bottom: 30px;
            }

            .form-title {
                color: #2c3e50;
                border-bottom: 2px solid #2c3e50;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            .btn-register {
                background-color: #2c3e50;
                color: white;
            }

            .btn-register:hover {
                background-color: #1a252f;
                color: white;
            }

            .required-field::after {
                content: " *";
                color: red;
            }
        </style>
    </head>

    <body>
        <?php include("navbar.php"); ?>

        <div class="container">
            <div class="registration-container">
                <h3 class="form-title">Update Student Details</h3>
                <form id="registrationForm">
                    <?php


                    $rs = DataBase::search("SELECT * FROM `student` WHERE `nic` = '" . $nic . "'");
                    $rows = $rs->num_rows;
                    if ($rows > 0) {
                        $data = $rs->fetch_assoc();
                    } else {
                        echo " <div class='alert alert-danger'>No student found with this NIC.</div>";

                    }

                    ?>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="fname" class="form-label required-field">First Name</label>
                            <input type="text" class="form-control" id="fname" required
                                value="<?php echo $data['firstname']; ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="lname" class="form-label required-field">Last Name</label>
                            <input type="text" class="form-control" id="lname" required
                                value="<?php echo $data['lastname']; ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nic" class="form-label required-field">NIC Number</label>
                            <input type="text" class="form-control" id="nic" disabled value="<?php echo $data['nic']; ?>">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label required-field">Gender</label>
                            <select class="form-select" id="gender">
                                <?php

                                $rs = DataBase::search("SELECT * FROM `gender`");
                                $rows = $rs->num_rows;
                                for ($x = 0; $x < $rows; $x++) {
                                    $genderData = $rs->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $genderData["id"]; ?>" <?php if ($genderData["id"] == $data["gender_id"]) {
                                           echo "selected";
                                       } ?>>
                                        <?php echo $genderData["gender_name"]; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" value="<?php echo $data['dob']; ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label required-field">Address</label>
                        <textarea class="form-control" id="address" rows="3"
                            required><?php echo $data['address']; ?>"</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact" class="form-label required-field">Contact Number</label>
                            <input type="tel" class="form-control" id="contact" disabled
                                value="<?php echo $data['mobile']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label required-field">Email</label>
                            <input type="email" class="form-control" id="email" disabled
                                value="<?php echo $data['email']; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="course" class="form-label required-field">Course</label>
                            <select class="form-select" id="course" required>
                                <option value="" selected disabled>Select Course</option>
                                <?php
                                $rs = DataBase::search("SELECT * FROM `course`");
                                $rows = $rs->num_rows;
                                for ($x = 0; $x < $rows; $x++) {
                                    $Coursedata = $rs->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $Coursedata["id"]; ?>" <?php
                                       if ($Coursedata["id"] == $data["course_id"]) {
                                           echo "selected";
                                       }
                                       ?>>
                                        <?php echo $Coursedata["course_name"]; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="intake" class="form-label">Intake Batch</label>
                            <select class="form-select" id="intake">
                                <option value="" selected disabled>Select Intake</option>
                                <?php
                                $rs = DataBase::search("SELECT * FROM `intake`");
                                $rows = $rs->num_rows;
                                for ($x = 0; $x < $rows; $x++) {
                                    $Intakedata = $rs->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $Intakedata["id"]; ?>" <?php if ($Intakedata["id"] == $data["intake_id"]) {
                                           echo "selected";
                                       } ?>>
                                        <?php echo $Intakedata["intake_name"]; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-register" onclick="UpdateStudent();">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>


    </body>

    </html>

    <?php
}

?>