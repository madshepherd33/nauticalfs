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
$mydbcolumnsstr = "service_image_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("service_image",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "service_image_id > ? and service_image_uniqid = ?";
$mydbarray = [0,$resulta['service_image_uniqid']];
$resultall = $dbcon->dbslca("service_image",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $result = $dbcon->dbdel("service_image",[$value2['service_image_id']],"service_image_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=service_gallery&s=".$_POST['uniqid']."&n=1");
}else{
    header("Location: ../index.php?f=service_gallery&s=".$_POST['uniqid']."&n=0");
}

?>