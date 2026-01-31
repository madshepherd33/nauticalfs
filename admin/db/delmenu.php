<?php 
ob_start();
session_start();
include "../class/connect.php";
include "../class/myclass.php";

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//FIND UNIQ ID
$mydbcolumnsstr = "menu_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("menu",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "menu_id > ? and menu_uniqid = ?";
$mydbarray = [0,$resulta['menu_uniqid']];
$resultall = $dbcon->dbslca("menu",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $result = $dbcon->dbdel("menu",[$value2['menu_id']],"menu_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=page_menu&s=1");
}else{
    header("Location: ../index.php?f=page_menu&s=0");
}

?>