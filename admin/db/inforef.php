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
$mydbcolumnsstr = "ref_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("ref",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "ref_id > ? and ref_uniqid = ?";
$mydbarray = [0,$resulta['ref_uniqid']];
$result = $dbcon->dbslca("ref",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "name-".$value["ref_lang"];
    $mykey2 = "file-".$value["ref_lang"];
    $mykey3 = "text-".$value["ref_lang"];
    $mykey4 = "finish-".$value["ref_lang"];
    $myreturndata[$mykey] = $value["ref_name"];
    $myreturndata[$mykey2] = $value["ref_image"];
    $myreturndata[$mykey3] = $value["ref_text"];
    $myreturndata[$mykey4] = $value["ref_finish"];
}
echo json_encode($myreturndata);
?>