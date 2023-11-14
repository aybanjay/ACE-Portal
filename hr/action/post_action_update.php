<?php

session_start();
include_once('../../admin/db_connect.php');

    $id = $_POST['hidden_id'];
    $company = $_POST['edit_company'];
    $location = $_POST['edit_location'];
    $description = $_POST['edit_description'];
    $job = $_POST['edit_job_title'];
    $sql = $conn->query("UPDATE careers SET company='$company', location='$location', job_title='$job',description='$description' WHERE id='$id'");

    if($sql){
        echo json_encode(array("statusCode"=>200));
    }else{
        echo json_encode(array("statusCode"=>201));
    }





?>