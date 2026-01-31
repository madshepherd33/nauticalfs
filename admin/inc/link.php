<?php
//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

if($p == "login"){
	$mydbcolumnsstr = "link_name = ? and link_active = ?";
	$mydbarray = ["login", 1];
	$result3 = $dbcon->dbslc("link",$mydbcolumnsstr,$mydbarray);
	if($result3 == false){
		header("Location: ./db/logout.php");
	}else{
		echo $result3["link_code"];
	}	
}else{
	//MENU CONTROL
	$mydbcolumnsstr = "admin_menu_url = ? and admin_menu_active = ?";
	$mydbarray = [$p, 1];
	$result = $dbcon->dbslc("admin_menu",$mydbcolumnsstr,$mydbarray);
	if($result == false){
		header("Location: ./db/logout.php");
	}else{
		//MENU TYPE CONTROL
		$mydbcolumnsstr = "menu_type_id = ? and menu_type_active = ?";
		$mydbarray = [$result['admin_menu_type'], 1];
		$result2 = $dbcon->dbslc("menu_type",$mydbcolumnsstr,$mydbarray);

		if($result2 == false){
			header("Location: ./db/logout.php");
		}else{
			$mydbcolumnsstr = "link_name = ? and link_active = ?";
			$mydbarray = [$result2['menu_type_name'], 1];
			$result3 = $dbcon->dbslc("link",$mydbcolumnsstr,$mydbarray);
			if($result3 == false){
				header("Location: ./db/logout.php");
			}else{
				echo $result3["link_code"];
			}	
		}
	}
}
?>