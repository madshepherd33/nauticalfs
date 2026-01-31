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
    $upl->set_path("../uploads/icons/");
    $upl->set_type("png");
    $uplresult = $upl->uploadfile();
    if($uplresult != 0){
        $mydbcolumnsstr = "social_media_name = ?, social_media_link = ?, social_media_icon = ?, social_media_color = ?";
        $mydbarray = [$_POST['name'],$_POST['link'],$uplresult,$_POST['color']];
    }else{
        header("Location: ../index.php?f=social_media&s=0");    
    }
}else{
    $mydbcolumnsstr = "social_media_name = ?, social_media_link = ?, social_media_color = ?";
    $mydbarray = [$_POST['name'],$_POST['link'],$_POST['color']];
}
$result = $dbcon->dbset("social_media",$mydbcolumnsstr,$mydbarray,$_POST['setid'],"social_media_id");
if($result != 0){
    header("Location: ../index.php?f=social_media&s=1");
}else{
    header("Location: ../index.php?f=social_media&s=0");
}


?>