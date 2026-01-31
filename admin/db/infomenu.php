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
$mydbcolumnsstr = "menu_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("menu",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "menu_id > ? and menu_uniqid = ?";
$mydbarray = [0,$resulta['menu_uniqid']];
$result = $dbcon->dbslca("menu",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "name-".$value["menu_lang"];
    $mykey2 = "url-".$value["menu_lang"];
    $myreturndata[$mykey] = $value["menu_name"];
    $myreturndata[$mykey2] = $value["menu_url"];
}
echo json_encode($myreturndata);
?>