<?php
session_start();
include_once('../../admin/db_connect.php');


$sql = $conn->prepare("INSERT INTO careers (company,location,job_title,description,user_id)VALUES(?,?,?,?,?)");
if ($sql) {
    $sql->bind_param("sssss", $company, $location, $job_title, $description,$uid);

    $uid = $_SESSION['id'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $job_title = $_POST['job_title'];
    $description = $_POST['description'];

    $sql->execute();
    $_SESSION['message'] = "Job has been added. Wait for the admin confirmation for job posting in public.";
    echo json_encode(array("statusCode" => 200));
} else {

    echo json_encode(array("statusCode" => 201));
}


$sql->close();
$conn->close();
