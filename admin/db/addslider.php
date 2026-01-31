<?php 
ob_start();
session_start();
include "../class/connect.php";
include "../class/myclass.php";

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//LANGUAGE CONTROL
$mydbcolumnsstr = "lang_id > ? and lang_active = ?";
$mydbarray = [0,1];
$resultLang = $dbcon->dbslca("lang",$mydbcolumnsstr,$mydbarray);

$lastArray = [];
foreach ($_POST as $key => $value) {
    $dataArray = explode("-",$key);
    $lastArray[$dataArray[1]][$dataArray[0]] = $value;    
}
foreach ($_FILES as $key => $value) {
    $dataArray = explode("-",$key);
    $lastArray[$dataArray[1]][$dataArray[0]] = $value;
}
$uniq = uniqid();
$isOK = 1;

foreach ($lastArray as $key2 => $value2) {
    //FILE PROGRESS
    $upl = new UploadFiles();
    $upl->set_file($value2['file']);
    $upl->set_path("../uploads/sliders/");
    $upl->set_type("png");
    $uplresult = $upl->uploadfile();
    if($uplresult != 0){
        $mydbcolumnsstr = ["slider_title","slider_order","slider_file","slider_uniqid","slider_lang","slider_active"];
        $mydbarray = [$value2['title'],1,$uplresult,$uniq,$key2,1];
        $result = $dbcon->dbadd("slider",$mydbcolumnsstr,$mydbarray);
        if($result != 0){}else{ $isOK = 0; }
    }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=slider&s=1");
}else{
    header("Location: ../index.php?f=slider&s=0");
}

?>