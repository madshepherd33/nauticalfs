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
$mydbcolumnsstr = "vission_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("vission",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "vission_id > ? and vission_uniqid = ?";
$mydbarray = [0,$resulta['vission_uniqid']];
$result = $dbcon->dbslca("vission",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "name-".$value["vission_lang"];
    $myreturndata[$mykey] = $value["vission_name"];
}
echo json_encode($myreturndata);
?>