<?php
include("connection.php");

if (isset($_GET['cid'])) {
    $course_id = $_GET['cid'];

    // Prepare and execute the SQL statement
    $rs = DataBase::search("SELECT `course_name` as `courseName`,`instructor`.`id` AS `instid`, CONCAT(`instructor`.`firstname`,' ',`instructor`.`lastname`) AS `instructorName`, `instructor`.`image_path` AS `imagePathofIns`
FROM `course`
INNER JOIN `instructor` ON `course`.`instructor` = `instructor`.id
WHERE `course`.`id` = '$course_id'");

    $rows = $rs->num_rows;
    if ($rows > 0) {
        $ins_data = $rs->fetch_assoc();
        // Output course details
        echo json_encode($ins_data);
    } else {
        // Course not found
        echo json_encode(["error" => "Course not found"]);
    }

} else {

}

?>