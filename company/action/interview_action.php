<?php

include '../db_connect.php';

$uid = $_POST['uid'];
$cid = $_POST['cid'];
$idate = $_POST["idate"];

$sql = $conn->query("UPDATE applicants SET status = 2, date_interview = '$idate' WHERE user_id = '$uid' AND career_id = '$cid'");

if($sql){
    echo json_encode(array("status"=>200));
}else{
    echo json_encode(array("status"=>201));
}