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
$mydbcolumnsstr = "ach_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("ach",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "ach_id > ? and ach_uniqid = ?";
$mydbarray = [0,$resulta['ach_uniqid']];
$resultall = $dbcon->dbslca("ach",$mydbcolumnsstr,$mydbarray);

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
$uniq = $resulta['ach_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "ach_uniqid = ? and ach_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("ach",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        //ADD SIDE
        //FILE PROGRESS
        $myfile = $value2['file'];
        $upl = new UploadFiles();
        $upl->set_file($myfile);
        $upl->set_path("../uploads/ach/");
        $upl->set_type("png");
        $uplresult = $upl->uploadfile();
        if($uplresult != false){
        }else{
            $isOK = 0; 
        }
        $mydbcolumnsstr = ["ach_name","ach_text","ach_image","ach_uniqid","ach_lang","ach_active"];
        $mydbarray = [$value2['name'],$value2['text'],$uplresult,$uniq,$key2,1];
        $resultl = $dbcon->dbadd("ach",$mydbcolumnsstr,$mydbarray);
        if($resultl != true){}else{ $isOK = true; }  
    }else{
        //FILE PROGRESS
        $myfile = $value2['file'];
        if ($myfile["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile);
            $upl->set_path("../uploads/ach/");
            $upl->set_type("png");
            $uplresult = $upl->uploadfile();
            if($uplresult != false){
                $mydbcolumnsstr = "ach_name = ?, ach_text = ?, ach_image = ?";
                $mydbarray = [$value2['name'],$value2['text'],$uplresult];
            }else{
                $isOK = 0;    
            }
        }else{
            $mydbcolumnsstr = "ach_name = ?, ach_text = ?";
            $mydbarray = [$value2['name'],$value2['text']];
        }
        //SET SIDE
        $resultl = $dbcon->dbset("ach",$mydbcolumnsstr,$mydbarray,$result['ach_id'],"ach_id");
        if($resultl != false){}else{ $isOK = false; }  
    }
}
if ($isOK == true) {
    header("Location: ../index.php?f=achievement&s=1");
}else{
    header("Location: ../index.php?f=achievement&s=0");
}


?>