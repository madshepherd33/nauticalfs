<?php 
ob_start();
session_start();
include "../class/connect.php";
include "../class/myclass.php";

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//FILE PROGRESS
if ($_FILES['file']['error'] != 4) {
    $upl = new UploadFiles();
    $upl->set_file($_FILES['file']);
    $upl->set_path("../uploads/user/");
    $upl->set_type("png");
    $uplresult = $upl->uploadfile();
    if($uplresult != 0){
        $mydbcolumnsstr = "user_name = ?,user_nick = ?,user_mail = ?,user_phone = ?,user_pass = ?, user_image_url = ?";
        $mydbarray = [$_POST['name'],$_POST['nick'],$_POST['mail'],$_POST['phone'],$_POST['pass'],$uplresult];
        $files  = 1;
    }else{
        header("Location: ../index.php?f=profile&s=0");    
    }
}else{
    $mydbcolumnsstr = "user_name = ?,user_nick = ?,user_mail = ?,user_phone = ?,user_pass = ?";
    $mydbarray = [$_POST['name'],$_POST['nick'],$_POST['mail'],$_POST['phone'],$_POST['pass']];
}
$result = $dbcon->dbset("user",$mydbcolumnsstr,$mydbarray,$_SESSION['user_id'],"user_id");
if($result != 0){
    if ($files == 1) {
        $_SESSION['user_image_url'] = $uplresult;
    }
    $_SESSION['user_name'] = $_POST['name'];
	$_SESSION['user_nick'] = $_POST['nick'];
    $_SESSION['user_mail'] = $_POST['mail'];
    $_SESSION['user_phone'] = $_POST['phone'];
	$_SESSION['user_pass'] = $_POST['pass'];
    header("Location: ../index.php?f=profile&s=1");
}else{
    header("Location: ../index.php?f=profile&s=0");
}


?>