<?php 
ob_start();
session_start();
include "../class/connect.php";
include "../class/myclass.php";

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();


$mydbcolumnsstr = "mail_list_active = ?";
$mydbarray = [0];
$result = $dbcon->dbset("mail_list",$mydbcolumnsstr,$mydbarray,$_POST['id'],"mail_list_id");

if($result != 0){
    header("Location: ../index.php?f=newsletter&s=1");
}else{
    header("Location: ../index.php?f=newsletter&s=0");
}

?>