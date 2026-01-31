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
$mydbcolumnsstr = "slider_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("slider",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "slider_id > ? and slider_uniqid = ?";
$mydbarray = [0,$resulta['slider_uniqid']];
$result = $dbcon->dbslca("slider",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "title-".$value["slider_lang"];
    $mykey2 = "file-".$value["slider_lang"];
    $myreturndata[$mykey] = $value["slider_title"];
    $myreturndata[$mykey2] = $value["slider_file"];
}
echo json_encode($myreturndata);
?>