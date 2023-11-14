<?php

// session_start();

include('../db_connect.php');

if($_POST['type']==1){


$id = $_POST['id'];
$sql  = $conn->query("SELECT user_id FROM careers WHERE id='$id'");

$row = $sql->fetch_assoc();


echo json_encode($row);

}
if($_POST['type']==2){


    $id = $_POST['id'];
    $sql  = $conn->query("SELECT username FROM users WHERE id='$id'");
    
    $row = $sql->fetch_assoc();
    
    
    echo json_encode($row);
    
    }
