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
$mydbcolumnsstr = "floki_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("floki",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "floki_id > ? and floki_uniqid = ?";
$mydbarray = [0,$resulta['floki_uniqid']];
$result = $dbcon->dbslca("floki",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "title-".$value["floki_lang"];
    $mykey2 = "icon-".$value["floki_lang"];
    $mykey3 = "text-".$value["floki_lang"];
    $myreturndata[$mykey] = $value["floki_title"];
    $myreturndata[$mykey2] = $value["floki_icon"];
    $myreturndata[$mykey3] = $value["floki_text"];
}
echo json_encode($myreturndata);
?>