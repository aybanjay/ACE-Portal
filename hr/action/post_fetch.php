<?php

session_start();
include_once('../../admin/db_connect.php');

$id = $_POST['id'];
if($_POST['type']==1){
    $sql = $conn->query("SELECT * FROM careers WHERE id ='$id'");

    $row = $sql->fetch_assoc();

    $data = array(
        "data" => $row
    );

    echo json_encode($row);
}




?>