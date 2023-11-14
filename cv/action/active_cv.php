<?php
session_start();
include('../../admin/db_connect.php');
if (isset($_SESSION['login_id'])) {


$id = $_POST['id'];
$user = $_POST['user'];

$sql = $conn->query("UPDATE cv SET status = 0 WHERE user_id = '$user'");

$sql = $conn->query("UPDATE cv SET status = 1 WHERE id = '$id'");


if($sql){
    echo json_encode(array("status"=>200));
}else{
    echo json_encode(array("status"=>201));
}


}else{
    header('location: index.php');
}
?>