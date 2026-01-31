<?php
ob_start();
session_start();

// Include connect PHP
include "./class/connect.php";
include "./class/myclass.php";
// Lang Query
if(!isset($_SESSION['lang'])){
	$_SESSION['lang'] = "en";
}
if(!isset($_SESSION['auth'])){
	$p = "login";
}else{
	if(!isset($_GET['f'])){
	$p = "main";
	}else{
		$p = $_GET['f'];
		if(file_exists('pages/'.$p.'.php')){
		}else{
			$p = "404";
		}
	}
}

include "./inc/upside.php";
include './pages/'.$p.'.php';
include "./inc/downside.php";
?>