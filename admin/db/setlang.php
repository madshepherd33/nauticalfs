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
    $upl->set_path("../uploads/flags/");
    $upl->set_type("png");
    $uplresult = $upl->uploadfile();
    if($uplresult != 0){
        $mydbcolumnsstr = "lang_name = ?, lang_flag = ?";
        $mydbarray = [$_POST['name'],$uplresult];
    }else{
        header("Location: ../index.php?f=lang&s=0");    
    }
}else{
    $mydbcolumnsstr = "lang_name = ?";
    $mydbarray = [$_POST['name']];
}
$result = $dbcon->dbset("lang",$mydbcolumnsstr,$mydbarray,$_POST['setid'],"lang_id");
if($result != 0){
    header("Location: ../index.php?f=lang&s=1");
}else{
    header("Location: ../index.php?f=lang&s=0");
}


?>