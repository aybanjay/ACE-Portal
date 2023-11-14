<?php

    include('../../admin/db_connect.php');

    $id = $_POST['id'];
    $qry = $conn->query("SELECT a.*,c.course,Concat(a.lastname,', ',a.firstname,' ',a.middlename) as name from alumnus_bio a inner join courses c on c.id = a.course_id where a.id= " .$id);

    $row = $qry->fetch_assoc();

    echo json_encode($row);

?>