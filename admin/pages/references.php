<?php 

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//LANGUAGE CONTROL
$mydbcolumnsstr = "lang_id > ? and lang_active = ?";
$mydbarray = [0,1];
$resultLang = $dbcon->dbslca("lang",$mydbcolumnsstr,$mydbarray);

$langnumaber = $resultLang[0]['lang_id'];

//TAKE MENU DATA
$mydbcolumnsstr = "ref_id > ? AND ref_lang = ?";
$mydbarray = [0,$langnumaber];
$result = $dbcon->dbslca("ref",$mydbcolumnsstr,$mydbarray);

?>
                <!-- BEGIN .app-main -->
                <div class="app-main">
                  <!-- BEGIN .main-heading -->
                  <header class="main-heading">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                          <div class="page-icon">
                            <i class="icon-bubbles3"></i>
                          </div>
                          <div class="page-users">
                            <h5>Reference List</h5>
                            <h6 class="sub-heading">Welcome to Floki Admin Panel</h6>
                          </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        </div>
                      </div>
                    </div>
                  </header>
                  <!-- END: .main-heading -->
                  <div class="main-content">
                      <!-- Row start -->
                      <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                          <div class="card">
                            <div class="card-header">
                                Reference List
                                <button type="button" class="btn  btn-success" style="float:right"  data-toggle="modal" data-target="#addModal"><i class="icon-plus"></i> New Reference</button>
                            </div>
                            <div class="card-body">
                              <table id="basicExample" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Text</th>
                                    <th>Finish Date</th>
                                    <th>Active</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php if($result == false){ }else{ foreach($result as $key => $value){ ?>
												          <tr>
                                    <td><?php echo $value['ref_name']; ?></td>
                                    <td><img src="./uploads/<?php echo $value['ref_image']; ?>" style="width:50px;" alt="<?php echo $value['ref_name']; ?>"></td>  
                                    <td><?php echo $value['ref_text']; ?></td>                            
                                    <td><?php echo $value['ref_finish']; ?></td>
                                    <td>
                                        <?php if($value['ref_active'] == 1){?>
                                            <span class="badge badge-pill badge-success">Active</span>
                                        <?php }else{ ?>
                                            <span class="badge badge-pill badge-warning">Passive</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $value['ref_date']; ?></td>
                                    <td>
                                        <?php if($value['ref_active'] == 1){?>
                                        <button class="btn btn-warning btn-rounded"  data-toggle="modal" data-target="#pasModal" onclick="pasFunc('<?php echo $value["ref_id"]; ?>')" ><i class="icon-star" style="color:white"></i></button>
                                        <?php }else{ ?>
                                        <button class="btn btn-success btn-rounded"  data-toggle="modal" data-target="#activeModal" onclick="actFunc('<?php echo $value["ref_id"]; ?>')" ><i class="icon-star" style="color:white"></i></button>
                                        <?php } ?>
                                        <button class="btn btn-info btn-rounded"  data-toggle="modal" data-target="#cogModal" onclick="setFunc('<?php echo $value["ref_id"]; ?>')" ><i class="icon-settings" style="color:white"></i></button>
                                        <button class="btn btn-danger btn-rounded"  data-toggle="modal" data-target="#delModal" onclick="delFunc('<?php echo $value["ref_id"]; ?>')" ><i class="icon-trash" style="color:white"></i></button>
                                    </td>
												          </tr>
                                  <?php } } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- Row ends -->
                    </div>
                  </div>
                  <!-- END: .app-main -->


                  <!-- Add Modal -->
                  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <form action="./db/addref.php" method="POST"  enctype="multipart/form-data">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="addModalLabel">New Reference Form</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                  <?php foreach ($resultLang as $keylang => $valuelang) { ?> 
                                  <li class="nav-item">
                                    <a class="nav-link <?php if($keylang == 0){ echo 'active'; } ?>" id="<?php echo $valuelang['lang_name'] ?>-tab" data-toggle="tab" href="#<?php echo $valuelang['lang_name'] ?>" role="tab" aria-controls="<?php echo $valuelang['lang_name'] ?>" aria-selected="true"><img src="<?php echo "./uploads/".$valuelang['lang_flag'] ?>" style="width:30px" alt="<?php echo "flag".$valuelang['lang_name'] ?>"></a>
                                  </li>
                                  <?php } ?>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                  <?php foreach ($resultLang as $keylang => $valuelang) { ?>
                                  <div class="tab-pane fade show <?php if($keylang == 0){ echo 'active'; } ?>" id="<?php echo $valuelang['lang_name'] ?>" role="tabpanel" aria-labelledby="<?php echo $valuelang['lang_name'] ?>-tab">
                                    <div class="form-row">
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Reference Name</label>
                                        <input type="text" required name="name-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Reference Name">
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Reference Text</label>
                                        <input type="text" required name="text-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Reference Text">
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Reference Image</label>
                                        <hr>
                                        <input type="file" required name="file-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1">
                                        <hr>
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Reference Finish Date</label>
                                        <input type="text" required name="finish-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Reference Finish Date">
                                      </div>
                                    </div>
                                  </div>
                                  <?php } ?> 
                                </div>                            
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success">Add Reference</button>
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>

                  <!-- Set Modal -->
                  <div class="modal fade" id="cogModal" tabindex="-1" role="dialog" aria-labelledby="cogModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/setref.php" method="POST"  enctype="multipart/form-data">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="cogModalLabel">Set Reference Form</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" id="setid" name="id">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                  <?php foreach ($resultLang as $keylang => $valuelang) { ?>
                                  <li class="nav-item">
                                    <a class="nav-link <?php if($keylang == 0){ echo 'active'; } ?>" id="set<?php echo $valuelang['lang_name'] ?>-tab" data-toggle="tab" href="#set<?php echo $valuelang['lang_name'] ?>" role="tab" aria-controls="<?php echo $valuelang['lang_name'] ?>" aria-selected="true"><img src="<?php echo "./uploads/".$valuelang['lang_flag'] ?>" style="width:30px" alt="<?php echo "flag".$valuelang['lang_name'] ?>"></a>
                                  </li>
                                  <?php } ?>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                  <?php foreach($resultLang as $keylang => $valuelang){ ?>
                                  <div class="tab-pane fade show  <?php if($keylang == 0){ echo 'active'; } ?>" id="set<?php echo $valuelang['lang_name'] ?>" role="tabpanel" aria-labelledby="set<?php echo $valuelang['lang_name'] ?>-tab">
                                    <div class="form-row">
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Reference Name</label>
                                        <input type="text" required name="name-<?php echo $valuelang['lang_id'] ?>"  class="form-control" id="name-<?php echo $valuelang['lang_id'] ?>" placeholder="Reference Name">
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Reference Text</label>
                                        <input type="text" required name="text-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="text-<?php echo $valuelang['lang_id'] ?>" placeholder="Reference Text">
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Current Image</label>
                                        <hr>
                                        <img src="awf" alt="<?php echo $valuelang['lang_name'] ?>" id="file-<?php echo $valuelang['lang_id'] ?>" style="width:50%;text-align:center;" >
                                        <hr>
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">New Image</label>
                                        <hr>
                                        <input type="file" name="file-<?php echo $valuelang['lang_id'] ?>" class="form-control">
                                        <hr>
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Reference Finish Date</label>
                                        <input type="text" required name="finish-<?php echo $valuelang['lang_id'] ?>" id="finish-<?php echo $valuelang['lang_id'] ?>" class="form-control" placeholder="Reference Finish Date">
                                      </div>
                                    </div>
                                  </div>
                                  <?php } ?>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Set Reference</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                  <!-- Del Modal -->
                  <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/delref.php" method="POST">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="delModalLabel">Delete Reference Form</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" id="delid" name="id">
                                <p>Are you sure ?</p>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-danger">Delete Reference</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>

                  <!-- Passive Modal -->
                  <div class="modal fade" id="pasModal" tabindex="-1" role="dialog" aria-labelledby="pasModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/statusref.php" method="POST">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="pasModalLabel">Passive Form</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" name="status" value="0" />
                                <input type="hidden" id="pasid" name="id">
                                <p>Are you sure ?</p>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-warning">Passive</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>

                  <!-- Active Modal -->
                  <div class="modal fade" id="activeModal" tabindex="-1" role="dialog" aria-labelledby="activeModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/statusref.php" method="POST">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="activeModalLabel">Active Form</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" name="status" value="1" />
                                <input type="hidden" id="actid" name="id">
                                <p>Are you sure ?</p>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success">Active</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>



<script>
    function setFunc(id){
      $.post("./db/inforef.php",{ id: ""+id+"" }, function(data,status){ 
        obj = JSON.parse(data);
        var mysubstr ="file";
        Object.keys(obj).forEach(function(key) {
          if(key.includes(mysubstr) == true){
            mystr = "./uploads/" + obj[key];
            document.getElementById(key).src = mystr;
          }else{
            document.getElementById(key).value = obj[key];
          }
        });
      });
      document.getElementById("setid").value = id;
    }
    function delFunc(id){
        document.getElementById("delid").value = id;
    }
    function pasFunc(id){
        document.getElementById("pasid").value = id;
    }
    function actFunc(id){
        document.getElementById("actid").value = id;
    }
</script>