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
$upl = new UploadFiles();
$upl->set_file($_FILES['file']);
$upl->set_path("../uploads/icons/");
$upl->set_type("png");
$uplresult = $upl->uploadfile();
if($uplresult != 0){
  $mydbcolumnsstr = ["social_media_name","social_media_link","social_media_icon","social_media_color","social_media_active"];
  $mydbarray = [$_POST['name'],$_POST['link'],$uplresult,$_POST['color'],1];
  $result = $dbcon->dbadd("social_media",$mydbcolumnsstr,$mydbarray);
  if($result != 0){
    header("Location: ../index.php?f=social_media&s=1");
  }else{
    header("Location: ../index.php?f=social_media&s=0");
  }
}else{
  header("Location: ../index.php?f=social_media&s=0");
}

?>