<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();
ob_start();

// Include connect PHP
include "./admin/class/connect.php";
include "./admin/class/myclass.php";
// Lang Query
if(!isset($_SESSION['lang'])){
	$_SESSION['lang'] = "EN";
}
if(!isset($_GET['f'])){
    $p = "main";
}else{
    $p = $_GET['f'];
    if(file_exists('pages/'.$p.'.php')){
    }else{
        $p = "404";
    }
}


include "./inc/upside.php";
include './pages/'.$p.'.php';
include "./inc/downside.php";

?>