<?php 
ob_start();
session_start();
include "../class/connect.php";
include "../class/myclass.php";

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();


$mydbcolumnsstr = "lang_active = ?";
$mydbarray = [$_POST['status']];
$result = $dbcon->dbset("lang",$mydbcolumnsstr,$mydbarray,$_POST['id'],"lang_id");

if($result != 0){
    header("Location: ../index.php?f=lang&s=1");
}else{
    header("Location: ../index.php?f=lang&s=0");
}

?>