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
$mydbcolumnsstr = "sub_service_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("sub_service",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "sub_service_id > ? and sub_service_uniqid = ?";
$mydbarray = [0,$resulta['sub_service_uniqid']];
$resultall = $dbcon->dbslca("sub_service",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $mydbcolumnsstr = "sub_service_active = ?";
    $mydbarray = [$_POST['status']];
    $result = $dbcon->dbset("sub_service",$mydbcolumnsstr,$mydbarray,$value2['sub_service_id'],"sub_service_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=sub_service&s=".$_POST['uniqid']."&n=1");
}else{
    header("Location: ../index.php?f=sub_service&s=".$_POST['uniqid']."&n=0");
}

?>