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
$mydbcolumnsstr = "ser_title_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("ser_title",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "ser_title_id > ? and ser_title_uniqid = ?";
$mydbarray = [0,$resulta['ser_title_uniqid']];
$resultall = $dbcon->dbslca("ser_title",$mydbcolumnsstr,$mydbarray);

$lastArray = [];
foreach ($_POST as $key => $value) {
    if(($key == "id")){}else{
        $dataArray = explode("-",$key);
        $lastArray[$dataArray[1]][$dataArray[0]] = $value;
    }    
}
$uniq = $resulta['ser_title_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "ser_title_uniqid = ? and ser_title_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("ser_title",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        $mydbcolumnsstr = ["ser_title_name","ser_title_uniqid","ser_title_lang","ser_title_active"];
        $mydbarray = [$value2['name'],$uniq,$key2,1];
        $resultl = $dbcon->dbadd("ser_title",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        $mydbcolumnsstr = "ser_title_name = ?";
        $mydbarray = [$value2['name']];
        $resultl = $dbcon->dbset("ser_title",$mydbcolumnsstr,$mydbarray,$result['ser_title_id'],"ser_title_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=services&s=1");
}else{
    header("Location: ../index.php?f=services&s=0");
}
?>