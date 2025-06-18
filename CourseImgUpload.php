<?php
include "connection.php";

if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
    $image = $_FILES["img"];
    $course = $_POST["c"];

    $allowed_image_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    $file_extension = $image["type"];

    if (in_array($file_extension, $allowed_image_extensions)) {

        $new_image_extension = "";

        if ($file_extension == "image/jpg") {
            $new_image_extension = ".jpg";
        } elseif ($file_extension == "image/jpeg") {
            $new_image_extension = ".jpeg";
        } elseif ($file_extension == "image/png") {
            $new_image_extension = ".png";
        } elseif ($file_extension == "image/svg+xml") {
            $new_image_extension = ".svg";
        }

        $file_name = "courseResources/" . $course . "_" . uniqid() . $new_image_extension;
        move_uploaded_file($image["tmp_name"], $file_name);

        // Save thumbnail path and course ID
        Database::iud("INSERT INTO `course_thumbnail` (`course_id`, `course_thumbnail`) VALUES ('$course', '$file_name')");

        echo "Success";
    } else {
        echo "Not an Allowed Image Type";
    }
} else {
    echo "Select An Image";
}
?>
