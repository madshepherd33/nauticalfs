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
$mydbcolumnsstr = "doc_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("doc",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "doc_id > ? and doc_uniqid = ?";
$mydbarray = [0,$resulta['doc_uniqid']];
$resultall = $dbcon->dbslca("doc",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $mydbcolumnsstr = "doc_active = ?";
    $mydbarray = [$_POST['status']];
    $result = $dbcon->dbset("doc",$mydbcolumnsstr,$mydbarray,$value2['doc_id'],"doc_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=document&s=1");
}else{
    header("Location: ../index.php?f=document&s=0");
}

?>