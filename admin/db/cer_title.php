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

//FIND UNIQ ID
$mydbcolumnsstr = "cer_title_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("cer_title",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "cer_title_id > ? and cer_title_uniqid = ?";
$mydbarray = [0,$resulta['cer_title_uniqid']];
$resultall = $dbcon->dbslca("cer_title",$mydbcolumnsstr,$mydbarray);

$lastArray = [];
foreach ($_POST as $key => $value) {
    if(($key == "id") OR (strstr($key,"file") != false)){}else{
        $dataArray = explode("-",$key);
        $lastArray[$dataArray[1]][$dataArray[0]] = $value;
    }    
}
foreach ($_FILES as $key => $value) {
    $dataArray = explode("-",$key);
    $lastArray[$dataArray[1]][$dataArray[0]] = $value;
}
$uniq = $resulta['cer_title_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "cer_title_uniqid = ? and cer_title_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("cer_title",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        $mydbcolumnsstr = ["cer_title_name","cer_title_uniqid","cer_title_lang","cer_title_active"];
        $mydbarray = [$value2['name'],$uniq,$key2,1];
        $resultl = $dbcon->dbadd("cer_title",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        $mydbcolumnsstr = "cer_title_name = ?";
        $mydbarray = [$value2['name']];
        $resultl = $dbcon->dbset("cer_title",$mydbcolumnsstr,$mydbarray,$result['cer_title_id'],"cer_title_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=certificate&s=1");
}else{
    header("Location: ../index.php?f=certificate&s=0");
}
?>