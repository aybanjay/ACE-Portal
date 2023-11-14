<?php

include('../db_connect.php');
$valid_extensions = array('jpeg', 'jpg', 'gif', 'bmp', 'pdf', 'doc', 'ppt', 'png');

$path = 'uploads/';

if ($_FILES['image']) {
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    $final_image = rand(1000, 1000000) . $img;

    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($final_image);

        if (move_uploaded_file($tmp, $path)) {
            echo "<img src='$path' />";
            $lname = "asasas";
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $email = $_POST['email'];
            $course = $_POST['course'];
            $batch = $_POST['batch'];
            $gender = $_POST['gender'];
            $address =  $_POST['address'];
            $insert = $conn->query("INSERT INTO alumnus_bio(avatar,firstname,middlename,lastname,email,course_id,batch,gender,address)
                                        VALUES('$path','$fname','$mname','$lname','$email','$course','$batch','$gender','$address')");
        }
    } else {
        echo "invalid";
    }
}
