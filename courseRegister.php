<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertex Institute - Course Registration</title>
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
    <?php include("navbar.php"); ?>

    <!-- Register Form for Courses -->
    <div class="container">
        <div class="registration-container">
            <h3 class="form-title">Course Registration Form</h3>
            <form id="registrationForm">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <?php
                        function generateRandomCode($length = 10)
                        {
                            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                            $randomString = '';

                            for ($i = 0; $i < $length; $i++) {
                                $index = random_int(0, strlen($characters) - 1);
                                $randomString .= $characters[$index];
                            }

                            return $randomString;
                        }

                        ?>
                        <label for="cid" class="form-label required-field">Course Id</label>
                        <input type="text" class="form-control" id="cid" value="<?php echo generateRandomCode(10); ?>" readonly />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cname" class="form-label required-field">Course Name</label>
                        <input type="text" class="form-control" id="cname" required />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cfee" class="form-label required-field">Course Fees</label>
                        <input type="text" class="form-control" id="cfee" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dob" class="form-label">Instructor</label>
                        <select class="form-select" id="instructor" required>
                            <option value="" selected disabled>Select Instructor</option>
                            <?php
                            $rs = DataBase::search("SELECT * FROM `instructor`");
                            $rows = $rs->num_rows;
                            for ($i = 0; $i < $rows; $i++) {
                                $data = $rs->fetch_assoc();
                                ?>
                                <option value="<?php echo $data["id"] ?>">
                                    <?php echo $data["firstname"] . ' ' . $data["lastname"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-outline-secondary me-md-2">Reset</button>
                    <button type="submit" class="btn btn-register" onclick="registerC();">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>

</body>

</html>