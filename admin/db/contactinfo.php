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
$mydbcolumnsstr = "contact_info_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("contact_info",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "contact_info_id > ? and contact_info_uniqid = ?";
$mydbarray = [0,$resulta['contact_info_uniqid']];
$resultall = $dbcon->dbslca("contact_info",$mydbcolumnsstr,$mydbarray);

$lastArray = [];
foreach ($_POST as $key => $value) {
    if($key == "id"){}else{
        $dataArray = explode("-",$key);
        $lastArray[$dataArray[1]][$dataArray[0]] = $value;
    }    
}
$uniq = $resulta['contact_info_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "contact_info_uniqid = ? and contact_info_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("contact_info",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        //ADD SIDE
        $mydbcolumnsstr = ["contact_info_phone_one","contact_info_mail","contact_info_gmap","contact_info_adres","contact_info_wp_number","contact_info_uniqid","contact_info_lang","contact_info_active"];
        $mydbarray = [$value2['phone'],$value2['mail'],$value2['gmap'],$value2['adres'],$value2['wp'],$uniq,$key2,1];
        $resultl = $dbcon->dbadd("contact_info",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        $mydbcolumnsstr = "contact_info_phone_one = ?, contact_info_mail = ?, contact_info_gmap = ?, contact_info_adres = ?, contact_info_wp_number = ?";
        $mydbarray = [$value2['phone'],$value2['mail'],$value2['gmap'],$value2['adres'],$value2['wp']];
        $resultl = $dbcon->dbset("contact_info",$mydbcolumnsstr,$mydbarray,$result['contact_info_id'],"contact_info_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=contact_info&s=1");
}else{
    header("Location: ../index.php?f=contact_info&s=0");
}


?>