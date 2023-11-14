

<?php

include '../db_connect.php';

$uid = $_POST['uid'];
$cid = $_POST['cid'];
$idate = $_POST["idate"];


$sql = $conn->query("SELECT careers.job_title AS jt, careers.company AS comp, careers.id AS cid, users.id AS uid,users.username AS umail, users.name as iname 
                    FROM users INNER JOIN careers ON users.id = '$uid' WHERE careers.id = '$cid';
                ");

$row = $sql->fetch_assoc();

echo json_encode($row);

//WHERE user_id = '$uid' AND career_id = '$cid'"