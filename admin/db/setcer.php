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
$mydbcolumnsstr = "cer_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("cer",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "cer_id > ? and cer_uniqid = ?";
$mydbarray = [0,$resulta['cer_uniqid']];
$resultall = $dbcon->dbslca("cer",$mydbcolumnsstr,$mydbarray);

$lastArray = [];
foreach ($_POST as $key => $value) {
    if($key == "id"){}else{
        $dataArray = explode("-",$key);
        $lastArray[$dataArray[1]][$dataArray[0]] = $value;
    }    
}
foreach ($_FILES as $key => $value) {
    $dataArray = explode("-",$key);
    $lastArray[$dataArray[1]][$dataArray[0]] = $value;
}
$uniq = $resulta['cer_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "cer_uniqid = ? and cer_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("cer",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        //ADD SIDE
        //FILE PROGRESS
        $myfile = $value2['file'];
        $upl = new UploadFiles();
        $upl->set_file($myfile);
        $upl->set_path("../uploads/cer/");
        $upl->set_type("png");
        $uplresult = $upl->uploadfile();
        if($uplresult != false){
        }else{
            $isOK = 0; 
        }
        $mydbcolumnsstr = ["cer_image","cer_uniqid","cer_lang","cer_active"];
        $mydbarray = [$uplresult,$uniq,$key2,1];
        $resultl = $dbcon->dbadd("cer",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        //FILE PROGRESS
        $myfile = $value2['file'];
        if ($myfile["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile);
            $upl->set_path("../uploads/cer/");
            $upl->set_type("png");
            $uplresult = $upl->uploadfile();
            if($uplresult != false){
                $mydbcolumnsstr = "cer_image = ?";
                $mydbarray = [$uplresult];
            }else{
                $isOK = 0;    
            }
        }else{}
        //SET SIDE
        $resultl = $dbcon->dbset("cer",$mydbcolumnsstr,$mydbarray,$result['cer_id'],"cer_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=certificate&s=1");
}else{
    header("Location: ../index.php?f=certificate&s=0");
}


?>