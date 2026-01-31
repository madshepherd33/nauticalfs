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
$mydbcolumnsstr = "menu_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("menu",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "menu_id > ? and menu_uniqid = ?";
$mydbarray = [0,$resulta['menu_uniqid']];
$resultall = $dbcon->dbslca("menu",$mydbcolumnsstr,$mydbarray);

$lastArray = [];
foreach ($_POST as $key => $value) {
    if($key == "id"){}else{
        $dataArray = explode("-",$key);
        $lastArray[$dataArray[1]][$dataArray[0]] = $value;
    }    
}
$uniq = $resulta['menu_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "menu_uniqid = ? and menu_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("menu",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        $mydbcolumnsstr = ["menu_name","menu_url","menu_uniqid","menu_lang","menu_active"];
        $mydbarray = [$value2['name'],$value2['url'],$uniq,$key2,1];
        $resultl = $dbcon->dbadd("menu",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        $mydbcolumnsstr = "menu_name = ?, menu_url = ?";
        $mydbarray = [$value2['name'],$value2['url']];
        $resultl = $dbcon->dbset("menu",$mydbcolumnsstr,$mydbarray,$result['menu_id'],"menu_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=page_menu&s=1");
}else{
    header("Location: ../index.php?f=page_menu&s=0");
}


?>