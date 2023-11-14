<?php
session_start();
include('../../admin/db_connect.php');
if (isset($_SESSION['login_id'])) {

    $id = $_POST['hidden_id_update'];

    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $job_title = $_POST['job_title'];
    $emp = $_POST['emp'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $course = $_POST['course'];
    $batch = $_POST['batch'];
    $cnumber = $_POST['cnumber'];

    $cname = $_POST['cfname'];
    $position = $_POST['position'];
    $cn = $_POST['cn'];
    $ref_1 = $cname . ", " . $position . ", " . $cn;

    $cname2 = $_POST['cfname2'];
    $position2 = $_POST['position2'];
    $cn2 = $_POST['cn2'];
    $ref_2 = $cname2 . ", " . $position2 . "," . $cn2;

    $cname3 = $_POST['cfname3'];
    $position3 = $_POST['position3'];
    $cn3 = $_POST['cn3'];
    $ref_3 = $cname3 . ", " . $position3 . ", " . $cn3;

    $skills = $_POST['skills'];
    $objectives = $_POST['objectives'];


    $sql = $conn->query("UPDATE cv SET objectives='$objectives',skills='$skills',course='$course',
                    batch='$batch',job_title='$job_title',emp='$emp',sdate='$sdate',edate='$edate',
                    ref_1='$ref_1',ref_2='$ref_2',ref_3='$ref_3',contact='$cnumber' WHERE id ='$id' ");

    if($sql){
        echo json_encode(array("status"=>200));
    }else{
        echo json_encode(array("status"=>201));
    }

  
} else {
    header('location: index.php');
}
