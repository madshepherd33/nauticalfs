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
$mydbcolumnsstr = "ref_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("ref",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "ref_id > ? and ref_uniqid = ?";
$mydbarray = [0,$resulta['ref_uniqid']];
$resultall = $dbcon->dbslca("ref",$mydbcolumnsstr,$mydbarray);

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
$uniq = $resulta['ref_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "ref_uniqid = ? and ref_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("ref",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        //ADD SIDE
        //FILE PROGRESS
        $myfile = $value2['file'];
        $upl = new UploadFiles();
        $upl->set_file($myfile);
        $upl->set_path("../uploads/ref/");
        $upl->set_type("png");
        $uplresult = $upl->uploadfile();
        if($uplresult != false){
        }else{
            $isOK = 0; 
        }
        $mydbcolumnsstr = ["ref_name","ref_text","ref_finish","ref_image","ref_uniqid","ref_lang","ref_active"];
        $mydbarray = [$value2['name'],$value2['text'],$value2['finish'],$uplresult,$uniq,$key2,1];
        $resultl = $dbcon->dbadd("ref",$mydbcolumnsstr,$mydbarray);
        if($resultl != false){}else{ $isOK = 0; }  
    }else{
        //FILE PROGRESS
        $myfile = $value2['file'];
        if ($myfile["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile);
            $upl->set_path("../uploads/ref/");
            $upl->set_type("png");
            $uplresult = $upl->uploadfile();
            if($uplresult != false){
                $mydbcolumnsstr = "ref_name = ?, ref_text = ?, ref_finish = ?, ref_image = ?";
                $mydbarray = [$value2['name'],$value2['text'],$value2['finish'],$uplresult];
            }else{
                $isOK = 0;    
            }
        }else{
            $mydbcolumnsstr = "ref_name = ?, ref_text = ?, ref_finish = ?";
            $mydbarray = [$value2['name'],$value2['text'],$value2['finish']];
        }
        //SET SIDE
        $resultl = $dbcon->dbset("ref",$mydbcolumnsstr,$mydbarray,$result['ref_id'],"ref_id");
        if($resultl != false){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=references&s=1");
}else{
    header("Location: ../index.php?f=references&s=0");
}


?>