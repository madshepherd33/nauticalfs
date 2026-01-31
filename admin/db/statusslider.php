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
$mydbcolumnsstr = "slider_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("slider",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "slider_id > ? and slider_uniqid = ?";
$mydbarray = [0,$resulta['slider_uniqid']];
$resultall = $dbcon->dbslca("slider",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $mydbcolumnsstr = "slider_active = ?";
    $mydbarray = [$_POST['status']];
    $result = $dbcon->dbset("slider",$mydbcolumnsstr,$mydbarray,$value2['slider_id'],"slider_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=slider&s=1");
}else{
    header("Location: ../index.php?f=slider&s=0");
}

?>