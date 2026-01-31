<?php
class MyDB {

  // DB PROPERTIES
  public $hostname;
  public $dbname;
  public $rootname;
  public $rootpassword;
  public $dbcharset;
  public $dbb;
  
  // INITIAL DB PROFILE
  function connect_initial() {
    $this->hostname = "localhost";
    $this->dbname = "floki";
    $this->rootname = "flokiroot";
    $this->rootpassword = "Aabdodo54.";
    $this->dbcharset = "utf8";
    $this->mycon();
  }

  // SET DB PROFILE
  function set_connect_initial($hostname,$dbname,$rootname,$rootpassword,$dbcharset) {
    $this->hostname = $hostname;
    $this->dbname = $dbname;
    $this->rootname = $rootname;
    $this->rootpassword = $rootpassword;
    $this->dbcharset = $dbcharset;
  }

  // EMPTY CONSTRUCT PART
  function __construct() {
    //connect db
  }
  
  // CREATE DB CONNECTION
  function mycon() {
    try{
      $this->dbb = new PDO("mysql:host=".$this->hostname.";dbname=".$this->dbname.";charset=".$this->dbcharset.";",$this->rootname,$this->rootpassword);
    }catch(PDOException $mesaj){
      $this->dbb = getmessage();
    }
  }
  
  // RETURN DB CONNECTION
  function db() {
    return $this->dbb;
  }

  // RETURN LAST INSERT ID
  function last_insert_id(){
  	return $this->dbb->lastInsertId();
  }

  // SHOW COLUMNS IN A TABLE 
  function show_columns($table){
  	$v = $this->dbb->prepare("SHOW COLUMNS FROM ".$table.""); 
    $v->execute();
    $rdata = $v->fetchAll(PDO::FETCH_ASSOC);
    $z = $v->rowCount();
    if($rdata){
      return $rdata;
    }else{
      return false;
    }
  }

  // SHOW TABLES IN A DB
  function show_tables(){
  	$v = $this->dbb->prepare("show tables from ".$this->dba.""); 
    $v->execute();
    $rdata = $v->fetchAll(PDO::FETCH_ASSOC);
    $z = $v->rowCount();
    if($rdata){
      return $rdata;
    }else{
      return false;
    }
  }

  // SELECT ARRAY TO PREPARE FOR INSERT DATA
  function insarr($data){
    $mytxt = "";
    foreach ($data as $key => $value) {
      if ($key == 0) {
        $mytxt = $value." = ?";
      }else{
        $mytxt = $mytxt.", ".$value." = ?";
      }
    }
    return $mytxt;
	}

  // SELECT ARRAY TO PREPARE FOR SET DATA
  function setarr($data){
    $mytxt = "";
    $mynum = count($data);
    foreach ($data as $key => $value) {
      if ($key == 0) {
        $mytxt = $value." = ?";
      }else{
        if ($mynum-1 == $key) {
          $mytxt = $mytxt." WHERE ".$value." = ?";
        }else{
          $mytxt = $mytxt.", ".$value." = ?";
        }
      }
    }
    return $mytxt;
	}

	// CREATE TABLE
	function dbcretab(){
    return 1;  	
  }

  // CREATE DB
  function dbcre($dbname){
    try {
      $conn = new PDO("mysql:host=".$this->hostname."", $this->rootname, $rootpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "CREATE DATABASE ".$dbname." ";
      // use exec() because no results are returned
      $conn->exec($sql);
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  // DELETE DATA
  function dbdel($table,$idNumber,$idName = "id"){
    $mydbstr = "DELETE FROM ".$table." WHERE ".$idName." = ?";
    $a = $this->dbb->prepare($mydbstr); 
    $b = $a->execute($idNumber);
    if($b){
      return true;
    }else{
      return false;
    }
  }

  // PASSIVE DATA
  function dbpas($table,$idNumber,$idName = "id"){
    $mydbstr = "UPDATE ".$table." SET active = ? where ".$idName." = ? ";
    $a = $this->dbb->prepare($mydbstr); 
    $b = $a->execute(array(0,$idNumber));
    if($b){
      return true;
    }else{
      return false;
    }
  }

  // SET DATA 
  function dbset($table,$columns,$data,$idNumber,$idName = "id"){
    $mydbstr = "UPDATE ".$table." SET ".$columns." WHERE ".$idName." = ? ";
    echo $mydbstr;
  	array_push($data, $idNumber);
    $a = $this->dbb->prepare($mydbstr); 
    $b = $a->execute($data);
    if($b){
      return true;
    }else{
      return false;
    }
  }

  // SELECT A DATA
  function dbslc($table,$columns,$data){
    $mydbstr = "SELECT * FROM ".$table." WHERE ".$columns;
    $v = $this->dbb->prepare($mydbstr); 
    $v->execute($data);
    $rdata = $v->fetchAll(PDO::FETCH_ASSOC);
    $z = $v->rowCount();
    if($z > 0){
      return $rdata[0];
    }else{
      return false;
    }
  }

  // SELECT MULTI DATA
  function dbslca($table,$columns,$data){
  	$mydbstr = "SELECT * FROM ".$table." WHERE ".$columns;
    $v = $this->dbb->prepare($mydbstr); 
    $v->execute($data);
    $rdata = $v->fetchAll(PDO::FETCH_ASSOC);
    $z = $v->rowCount();
    if($z > 0){
      return $rdata;
    }else{
      return false;
    }
	}
  
  // INSERT DATA
  function dbadd($table,$columns,$data) {
    $mycol = $this->insarr($columns);
  	$mydbstr = "INSERT INTO ".$table." SET ".$mycol;
    $a = $this->dbb->prepare($mydbstr); 

	  $b = $a->execute($data);
	  if($b){
		  return true;
    }else{
      return false;
    }
  }

  // SPECIFIC QUERY FOR DB
  function dbspc($query,$data) {
  	$mydbstr = $query;
    $v = $this->dbb->prepare($mydbstr); 
    $v->execute($data);
    $rdata = $v->fetchAll(PDO::FETCH_ASSOC);
    $z = $v->rowCount();
    if($rdata){
      return $rdata;
    }else{
      return false;
    }
  }
}
?>