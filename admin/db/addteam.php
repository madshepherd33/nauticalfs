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
    $upl->set_path("../uploads/team/");
    $upl->set_type("png");
    $uplresult = $upl->uploadfile();
    if($uplresult != false){
        $mydbcolumnsstr = ["team_name","team_title","team_image","team_mail","team_phone","team_ins","team_tw","team_fc","team_lk","team_uniqid","team_lang","team_active"];
        $mydbarray = [$value2['name'],$value2['title'],$uplresult,$value2['mail'],$value2['phone'],$value2['ins'],$value2['tw'],$value2['fc'],$value2['lk'],$uniq,$key2,1];
        $result = $dbcon->dbadd("team",$mydbcolumnsstr,$mydbarray);
        if($result != false){}else{ $isOK = 0; }
    }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=team&s=1");
}else{
    header("Location: ../index.php?f=team&s=0");
}

?>