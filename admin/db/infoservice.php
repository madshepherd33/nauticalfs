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
$mydbcolumnsstr = "service_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("service",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "service_id > ? and service_uniqid = ?";
$mydbarray = [0,$resulta['service_uniqid']];
$result = $dbcon->dbslca("service",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "name-".$value["service_lang"];
    $mykey2 = "text-".$value["service_lang"];
    $myreturndata[$mykey] = $value["service_name"];
    $myreturndata[$mykey2] = $value["service_text"];
}
echo json_encode($myreturndata);
?>