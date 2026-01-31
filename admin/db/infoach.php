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
$mydbcolumnsstr = "ach_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("ach",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "ach_id > ? and ach_uniqid = ?";
$mydbarray = [0,$resulta['ach_uniqid']];
$result = $dbcon->dbslca("ach",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "name-".$value["ach_lang"];
    $mykey2 = "file-".$value["ach_lang"];
    $mykey3 = "text-".$value["ach_lang"];
    $myreturndata[$mykey] = $value["ach_name"];
    $myreturndata[$mykey2] = $value["ach_image"];
    $myreturndata[$mykey3] = $value["ach_text"];
}
echo json_encode($myreturndata);
?>