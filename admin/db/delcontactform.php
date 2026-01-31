<?php 
ob_start();
session_start();
include "../class/connect.php";
include "../class/myclass.php";

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

$mydbcolumnsstr = "contact_form_active = ?";
$mydbarray = [0];
$result = $dbcon->dbset("contact_form",$mydbcolumnsstr,$mydbarray,$_POST['id'],"contact_form_id");
if($result != 0){}else{ $isOK = 0; }
if ($isOK == 1) {
    header("Location: ../index.php?f=contact_form&s=1");
}else{
    header("Location: ../index.php?f=contact_form&s=0");
}

?>