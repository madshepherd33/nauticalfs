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
$mydbcolumnsstr = "sub_service_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("sub_service",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "sub_service_id > ? and sub_service_uniqid = ?";
$mydbarray = [0,$resulta['sub_service_uniqid']];
$resultall = $dbcon->dbslca("sub_service",$mydbcolumnsstr,$mydbarray);

$lastArray = [];
foreach ($_POST as $key => $value) {
    if(($key == "id") OR ($key == "uniqid")){}else{
        $dataArray = explode("-",$key);
        $lastArray[$dataArray[1]][$dataArray[0]] = $value;
    }    
}
$uniq = $resulta['sub_service_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "sub_service_uniqid = ? and sub_service_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("sub_service",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        $mydbcolumnsstr = ["sub_service_name","sub_service_uniqid","sub_service_lang","sub_service_active"];
        $mydbarray = [$value2['name'],$uniq,$key2,1];
        $resultl = $dbcon->dbadd("sub_service",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        $mydbcolumnsstr = "sub_service_name = ?";
        $mydbarray = [$value2['name']];
        $resultl = $dbcon->dbset("sub_service",$mydbcolumnsstr,$mydbarray,$result['sub_service_id'],"sub_service_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=sub_service&s=".$_POST['uniqid']."&n=1");
}else{
    header("Location: ../index.php?f=sub_service&s=".$_POST['uniqid']."&n=0");
}


?>