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
$mydbcolumnsstr = "cer_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("cer",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "cer_id > ? and cer_uniqid = ?";
$mydbarray = [0,$resulta['cer_uniqid']];
$result = $dbcon->dbslca("cer",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey3 = "file-".$value["cer_lang"];
    $myreturndata[$mykey3] = $value["cer_image"];

}
echo json_encode($myreturndata);
?>