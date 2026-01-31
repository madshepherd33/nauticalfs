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

$myreturndata = [];
$mykey = "id";
$mykey2 = "name";
$mykey3 = "phone";
$mykey4 = "mail";
$mykey5 = "subject";
$mykey6 = "status";
$mykey7 = "message";
$mykey8 = "date";
$myreturndata[$mykey] = $resulta["contact_form_id"];
$myreturndata[$mykey2] = $resulta["contact_form_name"];
$myreturndata[$mykey3] = $resulta["contact_form_phone"];
$myreturndata[$mykey4] = $resulta["contact_form_mail"];
$myreturndata[$mykey5] = $resulta["contact_form_subject"];
$myreturndata[$mykey6] = $resulta["contact_form_status"];
$myreturndata[$mykey7] = $resulta["contact_form_message"];
$myreturndata[$mykey8] = $resulta["contact_form_date"];

echo json_encode($myreturndata);

?>