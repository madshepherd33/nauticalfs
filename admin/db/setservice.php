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
$mydbcolumnsstr = "service_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("service",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "service_id > ? and service_uniqid = ?";
$mydbarray = [0,$resulta['service_uniqid']];
$resultall = $dbcon->dbslca("service",$mydbcolumnsstr,$mydbarray);

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
$uniq = $resulta['service_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "service_uniqid = ? and service_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("service",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        //ADD SIDE
        //FILE PROGRESS
        $myfile = $value2['file'];
        $upl = new UploadFiles();
        $upl->set_file($myfile);
        $upl->set_path("../uploads/ser/");
        $upl->set_type("png");
        $uplresult = $upl->uploadfile();
        if($uplresult != false){
        }else{
            $isOK = 0; 
        }
        $mydbcolumnsstr = ["service_name","service_text","service_image","service_uniqid","service_lang","service_active"];
        $mydbarray = [$value2['name'],$value2['text'],$uplresult,$uniq,$key2,1];
        $resultl = $dbcon->dbadd("service",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        //FILE PROGRESS
        $myfile = $value2['file'];
        if ($myfile["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile);
            $upl->set_path("../uploads/ser/");
            $upl->set_type("png");
            $uplresult = $upl->uploadfile();
            if($uplresult != false){
                $mydbcolumnsstr = "service_name = ?, service_text = ?, service_image = ?";
                $mydbarray = [$value2['name'],$value2['text'],$uplresult];
            }else{
                $isOK = 0;    
            }
        }else{
            $mydbcolumnsstr = "service_name = ?, service_text = ?";
            $mydbarray = [$value2['name'],$value2['text']];
        }
        //SET SIDE
        $resultl = $dbcon->dbset("service",$mydbcolumnsstr,$mydbarray,$result['service_id'],"service_id");
        if($resultl != false){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=services&s=1");
}else{
    header("Location: ../index.php?f=services&s=0");
}


?>