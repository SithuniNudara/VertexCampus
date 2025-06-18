<?php

include("connection.php");

if (isset($_GET['courseID'])) {
    $course_id = $_GET['courseID'];

    // Prepare and execute the SQL statement
    $rs = DataBase::search("SELECT `course_name`,`instructor`,`course_fee`,`course`.`id`,`course_description` 
FROM `course`
WHERE `course`.`id` = '" . $course_id . "'");

    $rows = $rs->num_rows;
    if ($rows > 0) {
        $course_data = $rs->fetch_assoc();
        // Output course details
        echo json_encode($course_data);
    } else {
        // Course not found
        echo json_encode(["error" => "Course not found"]);
    }

} else {

}

?>