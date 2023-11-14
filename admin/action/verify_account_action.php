<?php

include_once("../db_connect.php");

$id = $_POST['verify_id'];
$email = $_POST['verify_email'];
$sql = $conn->query("UPDATE alumnus_bio SET status = 1 WHERE id='$id' AND email = '$email'");

if ($sql) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
