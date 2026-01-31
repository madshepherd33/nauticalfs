<?php 
ob_start();
session_start();
include "../class/connect.php";
include "../class/myclass.php";

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//FIND UNIQ ID
$mydbcolumnsstr = "service_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("service",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "service_id > ? and service_uniqid = ?";
$mydbarray = [0,$resulta['service_uniqid']];
$resultall = $dbcon->dbslca("service",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $mydbcolumnsstr = "service_active = ?";
    $mydbarray = [$_POST['status']];
    $result = $dbcon->dbset("service",$mydbcolumnsstr,$mydbarray,$value2['service_id'],"service_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=services&s=1");
}else{
    header("Location: ../index.php?f=services&s=0");
}

?>