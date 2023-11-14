<?php

session_start();
include_once('../../admin/db_connect.php');

$id = $_POST['id'];

$sql =$conn->query("DELETE FROM careers WHERE id='$id'");

if($sql){
    echo json_encode(array("statusCode"=>200));
}else{
    echo json_encode(array("statusCode"=>201));
}

?>