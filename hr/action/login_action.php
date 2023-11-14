<?php
session_start();
include_once('../../admin/db_connect.php');

if(isset($_POST['btnlogin'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    

    $sql = $conn->query("SELECT * FROM users WHERE username = '$email'");

   if(mysqli_num_rows($sql) > 0){
        $row = $sql->fetch_assoc();

        $verify_pass = password_verify( $pass,$row['password']);

       if($verify_pass){
            $_SESSION['email'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            header('location: ../dashboard.php');
       }else{
        
            $_SESSION['msg'] = "Invalid password";
            header('location: ../index.php');

       }
   }else{
     $_SESSION['msg'] = "No account found!";
     header('location: ../index.php');
   }


}