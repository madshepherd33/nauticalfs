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
$mydbcolumnsstr = "team_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("team",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "team_id > ? and team_uniqid = ?";
$mydbarray = [0,$resulta['team_uniqid']];
$resultall = $dbcon->dbslca("team",$mydbcolumnsstr,$mydbarray);

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
$uniq = $resulta['team_uniqid'];
$isOK = 1;
foreach ($lastArray as $key2 => $value2) {
    //FIND UNIQ ID
    $mydbcolumnsstr = "team_uniqid = ? and team_lang = ?";
    $mydbarray = [$uniq,$key2];
    $result = $dbcon->dbslc("team",$mydbcolumnsstr,$mydbarray);
    if ($result == false) {
        //ADD SIDE
        //FILE PROGRESS
        $myfile = $value2['file'];
        $upl = new UploadFiles();
        $upl->set_file($myfile);
        $upl->set_path("../uploads/team/");
        $upl->set_type("png");
        $uplresult = $upl->uploadfile();
        if($uplresult != false){
        }else{
            $isOK = 0; 
        }
        $mydbcolumnsstr = ["team_name","team_title","team_mail","team_phone","team_image","team_lk","team_fc","team_ins","team_tw","team_uniqid","team_lang","team_active"];
        $mydbarray = [$value2['name'],$value2['title'],$value2['mail'],$value2['phone'],$uplresult,$value2['lk'],$value2['fc'],$value2['ins'],$value2['tw'],$uniq,$key2,1];
        $resultl = $dbcon->dbadd("team",$mydbcolumnsstr,$mydbarray);
        if($resultl != 0){}else{ $isOK = 0; }  
    }else{
        //FILE PROGRESS
        $myfile = $value2['file'];
        if ($myfile["error"] != 4) {
            $upl = new UploadFiles();
            $upl->set_file($myfile);
            $upl->set_path("../uploads/team/");
            $upl->set_type("png");
            $uplresult = $upl->uploadfile();
            if($uplresult != false){
                $mydbcolumnsstr = "team_name = ?, team_title = ?, team_mail = ?, team_phone = ?, team_image = ?, team_lk = ?, team_fc = ?, team_ins = ?, team_tw = ?";
                $mydbarray = [$value2['name'],$value2['title'],$value2['mail'],$value2['phone'],$uplresult,$value2['lk'],$value2['fc'],$value2['ins'],$value2['tw']];
            }else{
                $isOK = 0;    
            }
        }else{
            $mydbcolumnsstr = "team_name = ?, team_title = ?, team_mail = ?, team_phone = ?, team_lk = ?, team_fc = ?, team_ins = ?, team_tw = ?";
            $mydbarray = [$value2['name'],$value2['title'],$value2['mail'],$value2['phone'],$value2['lk'],$value2['fc'],$value2['ins'],$value2['tw']];
        }
        //SET SIDE
        $resultl = $dbcon->dbset("team",$mydbcolumnsstr,$mydbarray,$result['team_id'],"team_id");
        if($resultl != false){}else{ $isOK = 0; }  
    }
}
if ($isOK == 1) {
    header("Location: ../index.php?f=team&s=1");
}else{
    header("Location: ../index.php?f=team&s=0");
}


?>