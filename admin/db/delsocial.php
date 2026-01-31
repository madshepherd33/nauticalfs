<?php 
ob_start();
session_start();
include "../class/connect.php";
include "../class/myclass.php";

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();


$result = $dbcon->dbdel("social_media",[$_POST['id']],"social_media_id");

if($result != 0){
    header("Location: ../index.php?f=social_media&s=1");
}else{
    header("Location: ../index.php?f=social_media&s=0");
}

?>