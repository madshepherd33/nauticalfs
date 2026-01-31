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
$mydbcolumnsstr = "floki_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("floki",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "floki_id > ? and floki_uniqid = ?";
$mydbarray = [0,$resulta['floki_uniqid']];
$resultall = $dbcon->dbslca("floki",$mydbcolumnsstr,$mydbarray);

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
$uniq = $resulta['floki_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "floki_uniqid = ? and floki_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("floki",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        //ADD SIDE
        //FILE PROGRESS
        $myfile = $value2['file'];
        $upl = new UploadFiles();
        $upl->set_file($myfile);
        $upl->set_path("../uploads/floki/");
        $upl->set_type("png");
        $uplresult = $upl->uploadfile();
        if($uplresult != 0){
        }else{
            $isOK = 0; 
        }
        $mydbcolumnsstr = ["floki_name","floki_text","floki_icon","floki_uniqid","floki_lang","floki_active"];
        $mydbarray = [$value2['name'],$value2['text'],$value2['icon'],$uniq,$key2,1];
        $resultl = $dbcon->dbadd("floki",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        //FILE PROGRESS
        $myfile = $value2['file'];
        if ($myfile["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile);
            $upl->set_path("../uploads/floki/");
            $upl->set_type("png");
            $uplresult = $upl->uploadfile();
            if($uplresult != 0){
                $mydbcolumnsstr = "floki_name = ?, floki_text = ?, floki_icon = ?";
                $mydbarray = [$value2['name'],$value2['text'],$value2['icon']];
            }else{
                $isOK = 0;    
            }
        }else{
            $mydbcolumnsstr = "floki_name = ?, floki_text = ?,floki_icon = ?";
            $mydbarray = [$value2['name'],$value2['text'],$value2['icon']];
        }
        //SET SIDE
        $resultl = $dbcon->dbset("floki",$mydbcolumnsstr,$mydbarray,$result['floki_id'],"floki_id");
        if($resultl != 0){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=home&s=1");
}else{
    header("Location: ../index.php?f=home&s=0");
}


?>