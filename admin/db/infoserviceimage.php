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
$mydbcolumnsstr = "service_image_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("service_image",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "service_image_id > ? and service_image_uniqid = ?";
$mydbarray = [0,$resulta['service_image_uniqid']];
$result = $dbcon->dbslca("service_image",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "file-".$value["service_image_lang"];
    $myreturndata[$mykey] = $value["service_image_file"];
}
echo json_encode($myreturndata);
?>