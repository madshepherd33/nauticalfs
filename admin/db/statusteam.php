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
$mydbcolumnsstr = "team_id = ?";
$mydbarray = [$_POST['id']];
$resulta = $dbcon->dbslc("team",$mydbcolumnsstr,$mydbarray);

//TAKE ALL DATA CONTROL
$mydbcolumnsstr = "team_id > ? and team_uniqid = ?";
$mydbarray = [0,$resulta['team_uniqid']];
$resultall = $dbcon->dbslca("team",$mydbcolumnsstr,$mydbarray);
$isOK = 1;

foreach ($resultall as $key2 => $value2) {
    $mydbcolumnsstr = "team_active = ?";
    $mydbarray = [$_POST['status']];
    $result = $dbcon->dbset("team",$mydbcolumnsstr,$mydbarray,$value2['team_id'],"team_id");
    if($result != 0){}else{ $isOK = 0; }  
}
if ($isOK == 1) {
    header("Location: ../index.php?f=team&s=1");
}else{
    header("Location: ../index.php?f=team&s=0");
}

?>