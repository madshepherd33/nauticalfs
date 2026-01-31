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
$upl->set_path("../uploads/flags/");
$upl->set_type("png");
$uplresult = $upl->uploadfile();
if($uplresult != 0){
  $mydbcolumnsstr = ["lang_name","lang_flag","lang_active"];
  $mydbarray = [$_POST['name'],$uplresult,1];
  $result = $dbcon->dbadd("lang",$mydbcolumnsstr,$mydbarray);
  if($result != 0){
    header("Location: ../index.php?f=lang&s=1");
  }else{
    header("Location: ../index.php?f=lang&s=0");
  }
}else{
  header("Location: ../index.php?f=lang&s=00");
}

?>