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
$mydbcolumnsstr = "slider_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("slider",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "slider_id > ? and slider_uniqid = ?";
$mydbarray = [0,$resulta['slider_uniqid']];
$resultall = $dbcon->dbslca("slider",$mydbcolumnsstr,$mydbarray);

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
$uniq = $resulta['slider_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "slider_uniqid = ? and slider_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("slider",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        //ADD SIDE
        //FILE PROGRESS
        $myfile = $value2['file'];
        $upl = new UploadFiles();
        $upl->set_file($myfile);
        $upl->set_path("../uploads/sliders/");
        $upl->set_type("png");
        $uplresult = $upl->uploadfile();
        if($uplresult != 0){
        }else{
            $isOK = 0; 
        }
        $mydbcolumnsstr = ["slider_title","slider_order","slider_file","slider_uniqid","slider_lang","slider_active"];
        $mydbarray = [$value2['title'],1,$uplresult,$uniq,$key2,1];
        $resultl = $dbcon->dbadd("slider",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        //FILE PROGRESS
        $myfile = $value2['file'];
        if ($myfile["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile);
            $upl->set_path("../uploads/sliders/");
            $upl->set_type("png");
            $uplresult = $upl->uploadfile();
            if($uplresult != 0){
                $mydbcolumnsstr = "slider_title = ?, slider_file = ?";
                $mydbarray = [$value2['title'],$uplresult];
            }else{
                $isOK = 0;    
            }
        }else{
            $mydbcolumnsstr = "slider_title = ?";
            $mydbarray = [$value2['title']];
        }
        //SET SIDE
        $resultl = $dbcon->dbset("slider",$mydbcolumnsstr,$mydbarray,$result['slider_id'],"slider_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=slider&s=1");
}else{
    header("Location: ../index.php?f=slider&s=0");
}


?>