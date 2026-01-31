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
$mydbcolumnsstr = "doc_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("doc",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "doc_id > ? and doc_uniqid = ?";
$mydbarray = [0,$resulta['doc_uniqid']];
$result = $dbcon->dbslca("doc",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($result as $key => $value) {
    $mykey = "name-".$value["doc_lang"];
    $mykey2 = "file-".$value["doc_lang"];
    $mykey3 = "text-".$value["doc_lang"];
    $myreturndata[$mykey] = $value["doc_name"];
    $myreturndata[$mykey2] = $value["doc_image"];
    $myreturndata[$mykey3] = $value["doc_text"];
}
echo json_encode($myreturndata);
?>