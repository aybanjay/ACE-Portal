<?php

session_start();
include('../../admin/db_connect.php');
if (isset($_SESSION['login_id'])) {
    $id = $_POST['id'];
    $sql = $conn->query("DELETE FROM cv WHERE id='$id'");

    if ($sql) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
} else {
    header('location: index.php');
}
