<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertex Institute - Instructor Update</title>
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
    <!-- Header -->
    <?php include "navbar.php";?>

    <!-- Register Form for Courses -->
    <div class="container">
        <div class="registration-container">
            <h3 class="form-title">Instructor Details Update</h3>
            <form id="registrationForm">
                <?php
                $id = $_GET['id'];
                $rs = DataBase::search("SELECT * FROM `instructor` WHERE `id` = '" . $id . "'");
                $rows = $rs->num_rows;
                if ($rows == 1) {
                    $data = $rs->fetch_assoc();
                } else {
                    echo "<div class='alert alert-danger'>No instructor found with the given ID.</div>";
                }
                ?>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="fname" class="form-label required-field">First Name</label>
                        <input type="text" class="form-control" id="fname" required
                            value="<?php echo $data["firstname"]; ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="lname" class="form-label required-field">Last Name</label>
                        <input type="text" class="form-control" id="lname" required
                            value="<?php echo $data["lastname"]; ?>">
                    </div>

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
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ifee" class="form-label required-field">Instructor Fees</label>
                        <input type="text" class="form-control" id="ifee" required placeholder="0.00"
                            value="<?php echo $data["fees"]; ?>" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dob" class="form-label">Date Of Birth</label>
                        <input type="date" class="form-control" id="dob" value="<?php echo $data["dob"]; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label required-field">Address</label>
                    <textarea class="form-control" id="address" rows="3"
                        required><?php echo $data["address"]; ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact" class="form-label required-field">Contact Number</label>
                        <input type="tel" class="form-control" id="contact" disabled
                            value="<?php echo $data["mobile"]; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label required-field">Email</label>
                        <input type="email" class="form-control" id="email" disabled
                            value="<?php echo $data["email"]; ?>">
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-outline-secondary me-md-2" onclick="reload();">Reset</button>
                    <button type="submit" class="btn btn-register" onclick="updateIns();">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        function reload() {
             window.location.reload();
        }
       
    </script>

</body>

</html>