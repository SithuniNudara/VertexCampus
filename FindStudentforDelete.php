<?php

include "connection.php";

$nic = $_GET["studentNIC"];
if (empty($nic)) {
    echo "NIC should Type Here";
} else {
    $rs = DataBase::search("SELECT * FROM `student` INNER JOIN `course` ON `student`.`course_id` = `course`.`id`
INNER JOIN `status` ON `student`.`status_id` = `status`.`id` WHERE `nic` = '" . $nic . "'");
    $rows = $rs->num_rows;
    if ($rows > 0) {
        for ($i = 0; $i < $rows; $i++) {
            $data = $rs->fetch_assoc();
            ?>

            <div class="card-header bg-light">
                <h5 class="mb-0 text-danger">Student Record to be Deleted</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><span class="detail-label">Full Name:</span> <span id="deleteName"><?php echo $data["firstname"]." ".$data["lastname"]; ?></span></p>
                        <p><span class="detail-label">NIC Number:</span> <span id="deleteNICDisplay"><?php echo $data["nic"] ?></span></p>
                        <p><span class="detail-label">Course:</span> <span id="deleteCourse"><?php echo $data["course_name"] ?></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><span class="detail-label">Contact:</span> <span id="deleteContact"><?php echo $data["mobile"] ?></span></p>
                        <p><span class="detail-label">Email:</span> <span id="deleteEmail"><?php echo $data["email"] ?></span></p>
                        <p><span class="detail-label">Status:</span> <span id="deleteStatus"><?php echo $data["status_name"] ?></span></p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="alert alert-danger">
                    <strong>Warning:</strong> This action cannot be undone. All records for this student will be permanently
                    deleted.
                </div>
                <form id="confirmDeleteForm" onsubmit="deleteStudent(event)">
                    <div class="mb-3">
                        <label for="confirmText" class="form-label">Type "DELETE" to confirm</label>
                        <input type="text" class="form-control" id="confirmText" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-delete">Permanently Delete Record</button>
                    </div>
                </form>
            </div>

            <?php
        }
    } else {
        echo "Student not Found with this NIC Number " . ":" . $nic;
    }
}

?>