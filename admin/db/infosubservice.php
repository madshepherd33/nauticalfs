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
$mydbcolumnsstr = "sub_service_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("sub_service",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "sub_service_id > ? and sub_service_uniqid = ?";
$mydbarray = [0,$resulta['sub_service_uniqid']];
$result = $dbcon->dbslca("sub_service",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "name-".$value["sub_service_lang"];
    $myreturndata[$mykey] = $value["sub_service_name"];
}
echo json_encode($myreturndata);
?>