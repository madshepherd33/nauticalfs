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
$mydbcolumnsstr = "vission_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("vission",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "vission_id > ? and vission_uniqid = ?";
$mydbarray = [0,$resulta['vission_uniqid']];
$resultall = $dbcon->dbslca("vission",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $result = $dbcon->dbdel("vission",[$value2['vission_id']],"vission_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=about_us&s=1");
}else{
    header("Location: ../index.php?f=about_us&s=0");
}

?>