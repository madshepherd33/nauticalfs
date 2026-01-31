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
$mydbcolumnsstr = "ref_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("ref",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "ref_id > ? and ref_uniqid = ?";
$mydbarray = [0,$resulta['ref_uniqid']];
$resultall = $dbcon->dbslca("ref",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $result = $dbcon->dbdel("ref",[$value2['ref_id']],"ref_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=references&s=1");
}else{
    header("Location: ../index.php?f=references&s=0");
}

?>