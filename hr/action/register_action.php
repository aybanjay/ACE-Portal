<?php

include_once('../../admin/db_connect.php');

$thisEmail = $_POST['email'];

$query = $conn->query("SELECT username FROM users WHERE username = '$thisEmail'");



if(mysqli_num_rows($query) > 0){
 //   $row = $query->fetch_assoc();
    echo json_encode(array("statusCode"=>202));

  
}else{
    $sql = $conn->prepare("INSERT INTO users (name,username,password,type)VALUES(?,?,?,?)");

    if ($sql) {
        $sql->bind_param('ssss', $fname, $email, $password, $status);
    

        $status = 5;
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $password =   password_hash($_POST['password'], PASSWORD_DEFAULT);
      
        $sql->execute();
        echo json_encode(array("statusCode" => 200));
    } else {
    
        echo json_encode(array("statusCode" => 201));
    }
    $sql->close();
    
}




$conn->close();
