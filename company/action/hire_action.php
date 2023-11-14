<?php

include '../db_connect.php';

$uid = $_POST['user_id'];
$cid = $_POST['career_id'];


$sql = $conn->query("UPDATE applicants SET status = 3 WHERE user_id = '$uid' AND career_id = '$cid'");

if($sql){
    echo json_encode(array("status"=>200));
}else{
    echo json_encode(array("status"=>201));
}