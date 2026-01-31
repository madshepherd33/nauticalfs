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
$mydbcolumnsstr = "our_approach_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("our_approach",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "our_approach_id > ? and our_approach_uniqid = ?";
$mydbarray = [0,$resulta['our_approach_uniqid']];
$resultall = $dbcon->dbslca("our_approach",$mydbcolumnsstr,$mydbarray);

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
$uniq = $resulta['our_approach_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "our_approach_uniqid = ? and our_approach_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("our_approach",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
       //FILE PROGRESS
       $myfile = $value2['mfile'];
       $myfile2 = $value2['sfile'];
       $myfile3 = $value2['vfile'];
       if ($myfile["error"] != 4) {
           $upl = new UploadFiles();
           $upl->set_file($myfile);
           $upl->set_path("../uploads/about/");
           $upl->set_type("png");
           $uplresultm = $upl->uploadfile();
       }else{
           $kkkk = "oldmfile".$key2;
           $uplresultm = $_POST[$kkkk];
       }
       if ($myfile2["error"] != 4) {
           $upl = new UploadFiles();
           $upl->set_file($myfile2);
           $upl->set_path("../uploads/about/");
           $upl->set_type("png");
           $uplresults = $upl->uploadfile();
       }else{
           $kkkk = "oldsfile".$key2;
           $uplresults = $_POST[$kkkk];
       }
       if ($myfile3["error"] != 4) {
           $upl = new UploadFiles();
           $upl->set_file($myfile3);
           $upl->set_path("../uploads/about/");
           $upl->set_type("png");
           $uplresultv = $upl->uploadfile();
       }else{
           $kkkk = "oldvfile".$key2;
           $uplresultv = $_POST[$kkkk];
       }
        $mydbcolumnsstr = ["our_approach_title","our_approach_text","our_approach_v_title","our_approach_v_text","our_approach_v_image","our_approach_m_title","our_approach_m_text","our_approach_m_image","our_approach_s_title","our_approach_s_text","our_approach_s_image","our_approach_uniqid","our_approach_lang","our_approach_active"];
        $mydbarray = [$value2['title'],$value2['text'],$value2['vtitle'],$value2['vtext'],$uplresultv,$value2['mtitle'],$value2['mtext'],$uplresultm,$value2['stitle'],$value2['stext'],$uplresults,$uniq,$key2,1];
        $resultl = $dbcon->dbadd("our_approach",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        //FILE PROGRESS
        $myfile = $value2['mfile'];
        $myfile2 = $value2['sfile'];
        $myfile3 = $value2['vfile'];
        if ($myfile["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile);
            $upl->set_path("../uploads/about/");
            $upl->set_type("png");
            $uplresultm = $upl->uploadfile();
        }else{
            $kkkk = "oldmfile".$key2;
            $uplresultm = $_POST[$kkkk];
        }
        if ($myfile2["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile2);
            $upl->set_path("../uploads/about/");
            $upl->set_type("png");
            $uplresults = $upl->uploadfile();
        }else{
            $kkkk = "oldsfile".$key2;
            $uplresults = $_POST[$kkkk];
        }
        if ($myfile3["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile3);
            $upl->set_path("../uploads/about/");
            $upl->set_type("png");
            $uplresultv = $upl->uploadfile();
        }else{
            $kkkk = "oldvfile".$key2;
            $uplresultv = $_POST[$kkkk];
        }
        $mydbcolumnsstr = "our_approach_title = ?, our_approach_text = ?, our_approach_v_title = ?, our_approach_v_text = ?, our_approach_v_image = ?, our_approach_m_title = ?, our_approach_m_text = ?, our_approach_m_image = ?, our_approach_s_title = ?, our_approach_s_text = ?, our_approach_s_image = ?";
        $mydbarray = [$value2['title'],$value2['text'],$value2['vtitle'],$value2['vtext'],$uplresultv,$value2['mtitle'],$value2['mtext'],$uplresultm,$value2['stitle'],$value2['stext'],$uplresults];
        //SET SIDE
        $resultl = $dbcon->dbset("our_approach",$mydbcolumnsstr,$mydbarray,$result['our_approach_id'],"our_approach_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=about_us&s=1");
}else{
    header("Location: ../index.php?f=about_us&s=0");
}


?>