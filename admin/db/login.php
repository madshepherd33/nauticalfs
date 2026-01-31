<?php 
ob_start();
session_start();
include "../class/connect.php";
include "../class/myclass.php";

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//LOGIN CONTROL
$mydbcolumnsstr = "user_nick = ? and user_active = ? and user_pass = ?";
$mydbarray = [$_POST['usr'], 1, $_POST['pas']];
$result = $dbcon->dbslc("user",$mydbcolumnsstr,$mydbarray);

if($result != false){
	$_SESSION['auth'] = 1;
	$_SESSION['user_name'] = $result['user_name'];
	$_SESSION['user_pass'] = $result['user_pass'];
	$_SESSION['user_status'] = $result['user_status'];
	$_SESSION['user_mail'] = $result['user_mail'];
	$_SESSION['user_active'] = $result['user_active'];
    $_SESSION['user_nick'] = $result['user_nick'];
	$_SESSION['user_image_url'] = $result['user_image_url'];
	$_SESSION['user_phone'] = $result['user_phone'];
	$_SESSION['user_date'] = $result['user_date'];
	$_SESSION['user_id'] = $result['user_id'];

	header("Location: ../index.php?p=main");
}else{
	header("Location: ../index.php");
}  
?>