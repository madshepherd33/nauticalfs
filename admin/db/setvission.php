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
$mydbcolumnsstr = "vission_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("vission",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "vission_id > ? and vission_uniqid = ?";
$mydbarray = [0,$resulta['vission_uniqid']];
$resultall = $dbcon->dbslca("vission",$mydbcolumnsstr,$mydbarray);

$lastArray = [];
foreach ($_POST as $key => $value) {
    if($key == "id"){}else{
        $dataArray = explode("-",$key);
        $lastArray[$dataArray[1]][$dataArray[0]] = $value;
    }    
}
$uniq = $resulta['vission_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "vission_uniqid = ? and vission_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("vission",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        $mydbcolumnsstr = ["vission_name","vission_uniqid","vission_lang","vission_active"];
        $mydbarray = [$value2['name'],$uniq,$key2,1];
        $resultl = $dbcon->dbadd("vission",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        $mydbcolumnsstr = "vission_name = ?";
        $mydbarray = [$value2['name']];
        $resultl = $dbcon->dbset("vission",$mydbcolumnsstr,$mydbarray,$result['vission_id'],"vission_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=about_us&s=1");
}else{
    header("Location: ../index.php?f=about_us&s=0");
}


?>