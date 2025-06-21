<?php

include("connection.php");

$id = $_GET['id'];
$rs = DataBase::search("SELECT * FROM `instructor` WHERE `id` = '" . $id . "'");
$rows = $rs->num_rows;
if ($rows > 0) {
    $data = $rs->fetch_assoc();
    ?>
    <!-- Student Details Card (would be populated dynamically) -->
    
        <div class="card-header bg-light">
            <h5 class="mb-0">Instructor Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><span class="detail-label">Full Name:</span> <span
                            id="detailName"><?php echo $data["firstname"] . " " . $data["lastname"]; ?></span></p>
                    <p><span class="detail-label">Instructor No:</span> <span
                            id="detailNIC"><?php echo $data["id"]; ?></span></p>
                    <?php
                    $displayGender = "";
                    $gender = $data["gender_id"];
                    if ($gender == 1) {
                        $displayGender = "Male";
                    } else {
                        $displayGender = "Female";
                    }
                    ?>
                    <p><span class="detail-label">Gender:</span> <span id="detailGender"><?php echo $displayGender; ?></span>
                    </p>
                    <p><span class="detail-label">Date of Birth:</span> <span
                            id="detailDOB"><?php echo $data["dob"]; ?></span></p>
                </div>
                <div class="col-md-6">
                    <p><span class="detail-label">Address:</span> <span
                            id="detailAddress"><?php echo $data["address"]; ?></span></p>
                    <p><span class="detail-label">Contact:</span> <span
                            id="detailContact"><?php echo $data["mobile"]; ?></span></p>
                    <p><span class="detail-label">Email:</span> <span id="detailEmail"><?php echo $data["email"]; ?></span>
                    </p>
                    <?php

                    $rs = DataBase::search("SELECT `course_name` FROM `course` WHERE `instructor` = '" . $data["id"] . "'");

                    $rows = $rs->num_rows;
                    $courseName = "";

                    if ($rows > 0) {

                        for ($i = 0; $i < $rows; $i++) {
                            $courseData = $rs->fetch_assoc();
                            $courseName = $courseData["course_name"];
                            echo "<p><span class='detail-label'>Course:</span> <span id='detailCourse'>" . $courseName . "</span></p>";
                        }

                    } else {
                        echo "<p class='text-danger'>No course assigned to this instructor.</p>";
                        $courseName = "N/A";
                    }

                    ?>
                    <p><span class="detail-label">Instructor Fees:</span> <span
                            id="detailFees"><?php echo $data["fees"]; ?></span></p>
                    
                </div>
            </div>
        </div>
        <div class="card-footer bg-light d-flex justify-content-end">
            <a class="btn btn-outline-primary" id="editBtn" href="editInstructor.php?id=<?php echo $data['id']; ?>">Edit Details</a>
        </div>
    

    
    <?php
}

?>