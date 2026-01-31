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
$mydbcolumnsstr = "home_about_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("home_about",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "home_about_id > ? and home_about_uniqid = ?";
$mydbarray = [0,$resulta['home_about_uniqid']];
$resultall = $dbcon->dbslca("home_about",$mydbcolumnsstr,$mydbarray);

$lastArray = [];
foreach ($_POST as $key => $value) {
    if(($key == "id") OR (strstr($key,"file") != false)){}else{
        $dataArray = explode("-",$key);
        $lastArray[$dataArray[1]][$dataArray[0]] = $value;
    }    
}
foreach ($_FILES as $key => $value) {
    $dataArray = explode("-",$key);
    $lastArray[$dataArray[1]][$dataArray[0]] = $value;
}
$uniq = $resulta['home_about_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "home_about_uniqid = ? and home_about_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("home_about",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
       //FILE PROGRESS
       $myfile = $value2['file'];
       if ($myfile["error"] != 4) {
           $upl = new UploadFiles();
           $upl->set_file($myfile);
           $upl->set_path("../uploads/home/");
           $upl->set_type("png");
           $uplresult = $upl->uploadfile();
       }else{
           $kkkk = "oldfile".$key2;
           $uplresult = $_POST[$kkkk];
       }
        $mydbcolumnsstr = ["home_about_title","home_about_text","home_about_file","home_about_uniqid","home_about_lang","home_about_active"];
        $mydbarray = [$value2['title'],$value2['text'],$uplresult,$uniq,$key2,1];
        $resultl = $dbcon->dbadd("home_about",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        //FILE PROGRESS
        $myfile = $value2['file'];
        if ($myfile["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile);
            $upl->set_path("../uploads/home/");
            $upl->set_type("png");
            $uplresult = $upl->uploadfile();
        }else{
            $kkkk = "oldfile".$key2;
            $uplresult = $_POST[$kkkk];
        }
        $mydbcolumnsstr = "home_about_title = ?, home_about_text = ?, home_about_file = ?";
        $mydbarray = [$value2['title'],$value2['text'],$uplresult];
        //SET SIDE
        $resultl = $dbcon->dbset("home_about",$mydbcolumnsstr,$mydbarray,$result['home_about_id'],"home_about_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=home&s=1");
}else{
    header("Location: ../index.php?f=home&s=0");
}


?>