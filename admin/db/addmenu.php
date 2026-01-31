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

$uniq = uniqid();
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    $mydbcolumnsstr = ["menu_name","menu_url","menu_uniqid","menu_lang","menu_active"];
    $mydbarray = [$value2['name'],$value2['url'],$uniq,$key2,1];
    $result = $dbcon->dbadd("menu",$mydbcolumnsstr,$mydbarray);
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=page_menu&s=1");
}else{
    header("Location: ../index.php?f=page_menu&s=0");
}

?>