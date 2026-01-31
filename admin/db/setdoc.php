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
$mydbcolumnsstr = "doc_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("doc",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "doc_id > ? and doc_uniqid = ?";
$mydbarray = [0,$resulta['doc_uniqid']];
$resultall = $dbcon->dbslca("doc",$mydbcolumnsstr,$mydbarray);

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
$uniq = $resulta['doc_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "doc_uniqid = ? and doc_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("doc",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        //ADD SIDE
        //FILE PROGRESS
        $myfile = $value2['file'];
        $upl = new UploadFiles();
        $upl->set_file($myfile);
        $upl->set_path("../uploads/doc/");
        $mytype = explode(".",$value2['file']['name']);
        $upl->set_type(end($mytype));
        $uplresult = $upl->uploadfile();
        if($uplresult != false){
        }else{
            $isOK = 0; 
        }
        $mydbcolumnsstr = ["doc_name","doc_text","doc_image","doc_uniqid","doc_lang","doc_active"];
        $mydbarray = [$value2['name'],$value2['text'],$uplresult,$uniq,$key2,1];
        $resultl = $dbcon->dbadd("doc",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        //FILE PROGRESS
        $myfile = $value2['file'];
        if ($myfile["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile);
            $upl->set_path("../uploads/doc/");
            $mytype = explode(".",$value2['file']['name']);
            $upl->set_type(end($mytype));
            $uplresult = $upl->uploadfile();
            if($uplresult != false){
                $mydbcolumnsstr = "doc_name = ?, doc_text = ?, doc_image = ?";
                $mydbarray = [$value2['name'],$value2['text'],$uplresult];
            }else{
                $isOK = 0;    
            }
        }else{
            $mydbcolumnsstr = "doc_name = ?, doc_text = ?";
            $mydbarray = [$value2['name'],$value2['text']];
        }
        //SET SIDE
        $resultl = $dbcon->dbset("doc",$mydbcolumnsstr,$mydbarray,$result['doc_id'],"doc_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=document&s=1");
}else{
    header("Location: ../index.php?f=document&s=0");
}


?>