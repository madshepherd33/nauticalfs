<?php 

class UploadFiles{

  // UPLOAD FILES PROPERTIES
  public $path;
  public $file;
  public $type;

  function set_path($setpath){
    $this->path = $setpath;
  }

  function get_path(){
    return $this->path;
  }

  function set_type($settype){
    $this->type = $settype;
  }

  function get_type(){
    return $this->type;
  }

  function set_file($myfile){
    $this->file = $myfile;
  }

  function uploadfile(){
  
    $target_dir = $this->path;
    $target_file = $target_dir . uniqid() . "." . $this->type;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (move_uploaded_file($this->file["tmp_name"], $target_file)) {
      return $target_file;
    } else {
      return 0;  
    }

  }
  
}

?>