<?php
session_start();
include('../../admin/db_connect.php');
if (isset($_SESSION['login_id'])) {

$id = $_POST['id'];


$sql = $conn->query("SELECT * FROM cv WHERE id = '$id'");

$row=$sql->fetch_assoc();

echo json_encode($row);

}else{
    header('location: index.php');
}
