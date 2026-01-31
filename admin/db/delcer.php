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
$mydbcolumnsstr = "cer_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("cer",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "cer_id > ? and cer_uniqid = ?";
$mydbarray = [0,$resulta['cer_uniqid']];
$resultall = $dbcon->dbslca("cer",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $result = $dbcon->dbdel("cer",[$value2['cer_id']],"cer_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=certificate&s=1");
}else{
    header("Location: ../index.php?f=certificate&s=0");
}

?>