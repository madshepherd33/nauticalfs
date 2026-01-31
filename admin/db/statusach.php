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
$mydbcolumnsstr = "ach_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("ach",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "ach_id > ? and ach_uniqid = ?";
$mydbarray = [0,$resulta['ach_uniqid']];
$resultall = $dbcon->dbslca("ach",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $mydbcolumnsstr = "ach_active = ?";
    $mydbarray = [$_POST['status']];
    $result = $dbcon->dbset("ach",$mydbcolumnsstr,$mydbarray,$value2['ach_id'],"ach_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=achievement&s=1");
}else{
    header("Location: ../index.php?f=achievement&s=0");
}

?>