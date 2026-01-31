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
$mydbcolumnsstr = "contact_form_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("contact_form",$mydbcolumnsstr,$mydbarray);
if($resulta['contact_form_status'] == "0"){
    $mydbcolumnsstra = "contact_form_status = ?";
    $mydbarraya = [1];
    $result = $dbcon->dbset("contact_form",$mydbcolumnsstra,$mydbarraya,$_POST['id'],"contact_form_id");
}
?>
