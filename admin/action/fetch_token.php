<?php
//session_start();
include('../db_connect.php');

$email = $_POST['email'];

$sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '$email'");

$res = $sql->fetch_assoc();



if (mysqli_num_rows($sql) > 0) {
    echo json_encode($res);
} else {
    echo json_encode(array("status" => 201));
}
