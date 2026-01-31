<?php 
ob_start();
session_start();
include "../class/connect.php";
include "../class/myclass.php";

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//LANG CONTROL
$mydbcolumnsstr = "lang_id > ? and lang_active = ?";
$mydbarray = [0,1];
$resultlang = $dbcon->dbslc("lang",$mydbcolumnsstr,$mydbarray);

//FIND UNIQ ID
$mydbcolumnsstr = "team_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("team",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "team_id > ? and team_uniqid = ?";
$mydbarray = [0,$resulta['team_uniqid']];
$result = $dbcon->dbslca("team",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "name-".$value["team_lang"];
    $mykey2 = "title-".$value["team_lang"];
    $mykey3 = "file-".$value["team_lang"];
    $mykey4 = "mail-".$value["team_lang"];
    $mykey5 = "phone-".$value["team_lang"];
    $mykey7 = "fc-".$value["team_lang"];
    $mykey8 = "tw-".$value["team_lang"];
    $mykey9 = "ins-".$value["team_lang"];
    $mykey10 = "lk-".$value["team_lang"];
    $myreturndata[$mykey] = $value["team_name"];
    $myreturndata[$mykey2] = $value["team_title"];
    $myreturndata[$mykey3] = $value["team_image"];
    $myreturndata[$mykey4] = $value["team_mail"];
    $myreturndata[$mykey5] = $value["team_phone"];
    $myreturndata[$mykey7] = $value["team_fc"];
    $myreturndata[$mykey8] = $value["team_tw"];
    $myreturndata[$mykey9] = $value["team_ins"];
    $myreturndata[$mykey10] = $value["team_lk"];

}
echo json_encode($myreturndata);
?>