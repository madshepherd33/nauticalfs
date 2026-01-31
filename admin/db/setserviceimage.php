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
$mydbcolumnsstr = "service_image_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("service_image",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "service_image_id > ? and service_image_uniqid = ?";
$mydbarray = [0,$resulta['service_image_uniqid']];
$resultall = $dbcon->dbslca("service_image",$mydbcolumnsstr,$mydbarray);

$lastArray = [];
foreach ($_POST as $key => $value) {
    if(($key == "id") OR ($key == "uniqid")){}else{
        $dataArray = explode("-",$key);
        $lastArray[$dataArray[1]][$dataArray[0]] = $value;
    }    
}
foreach ($_FILES as $key => $value) {
    $dataArray = explode("-",$key);
    $lastArray[$dataArray[1]][$dataArray[0]] = $value;
}
$uniq = $resulta['service_image_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "service_image_uniqid = ? and service_image_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("service_image",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        //ADD SIDE
        //FILE PROGRESS
        $myfile = $value2['file'];
        $upl = new UploadFiles();
        $upl->set_file($myfile);
        $upl->set_path("../uploads/ser/");
        $upl->set_type("png");
        $uplresult = $upl->uploadfile();
        if($uplresult != 0){
        }else{
            $isOK = 0; 
        }
        $mydbcolumnsstr = ["service_image_file","service_select_id","service_image_uniqid","service_image_lang","service_image_active"];
        $mydbarray = [$value2['file'],$_POST['uniqid'],$uplresult,$uniq,$key2,1];
        $resultl = $dbcon->dbadd("service_image",$mydbcolumnsstr,$mydbarray);
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
            if($uplresult != 0){
                $mydbcolumnsstr = "service_image_file = ?";
                $mydbarray = [$uplresult];
            }else{
                $isOK = 0;    
            }
        }else{
            header("Location: ../index.php?f=service_gallery&s=".$_POST['uniqid']."&n=1");
        }
        //SET SIDE
        $resultl = $dbcon->dbset("service_image",$mydbcolumnsstr,$mydbarray,$result['service_image_id'],"service_image_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=service_gallery&s=".$_POST['uniqid']."&n=1");
}else{
    header("Location: ../index.php?f=service_gallery&s=".$_POST['uniqid']."&n=0");
}


?>