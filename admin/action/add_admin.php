<?php

session_start();

include("../db_connect.php");

$name = $_POST['name_admin'];
$username = $_POST['username_admin'];
$type = $_POST['type_admin'];
$sql = $conn->query("SELECT username FROM users WHERE username='$username'");

$row = $sql->num_rows;


if ($row > 0) {
    $data = array(
        "status"   => "1"
    );
    echo json_encode($data);
} else {
    $pass = md5($username);
    $qry = $conn->query("INSERT INTO users(name,username,password,type)VALUES('$name','$username','$pass','$type')");
    if ($qry) {


        $data = array(
            "status"   => "0"
        );
        echo json_encode($data);
    }else{
        $data = array(
            "status"   => "2"
        );
        echo json_encode($data);
    }
}
