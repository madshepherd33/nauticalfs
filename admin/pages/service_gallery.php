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
$mydbcolumnsstr = "service_image_id > ? AND service_image_lang = ? AND service_select_id = ?";
$mydbarray = [0,$langnumaber,$_GET['s']];
$result = $dbcon->dbslca("service_image",$mydbcolumnsstr,$mydbarray);


//TAKE DATA
$mydbcolumnsstr = "service_uniqid = ? AND service_lang = ?";
$mydbarray = [$_GET['s'],$langnumaber];
$resultold = $dbcon->dbslc("service",$mydbcolumnsstr,$mydbarray);

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
                            <h5>Service Image List</h5>
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
                                <?php echo $resultold['service_name'] ?>'s Service Image List
                                <button type="button" class="btn  btn-success" style="float:right"  data-toggle="modal" data-target="#addModal"><i class="icon-plus"></i> New Gallery Image</button>
                            </div>
                            <div class="card-body">
                              <table id="basicExample" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>Image</th>
                                    <th>Active</th>
                                    <th>Date</th>
                                    <th>Sub Service</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php if($result == false){ }else{ foreach($result as $key => $value){ ?>
								<tr>
                                    <td><img src="./uploads/<?php echo $value['service_image_file']; ?>" style="width:50px;" alt="<?php echo $value['service_image_id']; ?>"></td>  
                                    <td>
                                        <?php if($value['service_image_active'] == 1){?>
                                            <span class="badge badge-pill badge-success">Active</span>
                                        <?php }else{ ?>
                                            <span class="badge badge-pill badge-warning">Passive</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $value['service_image_date']; ?></td>
                                    <td>
                                        <a class="btn btn-secondary btn-rounded" href="./index.php?f=sub_service&s=<?php echo $value['service_select_id']; ?>"><i class="icon-list" style="color:white"></i></button>
                                    </td>
                                    <td>
                                        <?php if($value['service_image_active'] == 1){?>
                                        <button class="btn btn-warning btn-rounded"  data-toggle="modal" data-target="#pasModal" onclick="pasFunc('<?php echo $value["service_image_id"]; ?>')" ><i class="icon-star" style="color:white"></i></button>
                                        <?php }else{ ?>
                                        <button class="btn btn-success btn-rounded"  data-toggle="modal" data-target="#activeModal" onclick="actFunc('<?php echo $value["service_image_id"]; ?>')" ><i class="icon-star" style="color:white"></i></button>
                                        <?php } ?>
                                        <button class="btn btn-info btn-rounded"  data-toggle="modal" data-target="#cogModal" onclick="setFunc('<?php echo $value["service_image_id"]; ?>')" ><i class="icon-settings" style="color:white"></i></button>
                                        <button class="btn btn-danger btn-rounded"  data-toggle="modal" data-target="#delModal" onclick="delFunc('<?php echo $value["service_image_id"]; ?>')" ><i class="icon-trash" style="color:white"></i></button>
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
                              <form action="./db/addserviceimage.php" method="POST"  enctype="multipart/form-data">
                              <div class="modal-header">
                                  <input type="hidden" name="uniqid" value="<?php echo $_GET['s']; ?>">
                                  <h5 class="modal-title" id="addModalLabel">New Gallery Image Form</h5>
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
                                        <label for="input1" class="col-form-label">Service Image</label>
                                        <hr>
                                        <input type="file" required name="file-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1">
                                        <hr>
                                      </div>
                                    </div>
                                  </div>
                                  <?php } ?> 
                                </div>                            
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success">Add Gallery Image</button>
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>

                  <!-- Set Modal -->
                  <div class="modal fade" id="cogModal" tabindex="-1" role="dialog" aria-labelledby="cogModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/setserviceimage.php" method="POST"  enctype="multipart/form-data">
                              <div class="modal-header">
                                  <input type="hidden" name="uniqid" value="<?php echo $_GET['s']; ?>">
                                  <h5 class="modal-title" id="cogModalLabel">Set Gallery Image Form</h5>
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
                                    </div>
                                  </div>
                                  <?php } ?>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Set Gallery Image</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                  <!-- Del Modal -->
                  <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/delserviceimage.php" method="POST">
                              <div class="modal-header">
                                  <input type="hidden" name="uniqid" value="<?php echo $_GET['s']; ?>">
                                  <h5 class="modal-title" id="delModalLabel">Delete Gallery Image Form</h5>
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
                                  <button type="submit" class="btn btn-danger">Delete Gallery Image</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>

                  <!-- Passive Modal -->
                  <div class="modal fade" id="pasModal" tabindex="-1" role="dialog" aria-labelledby="pasModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/statusserviceimage.php" method="POST">
                              <div class="modal-header">
                                  <input type="hidden" name="uniqid" value="<?php echo $_GET['s']; ?>">
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
                          <form action="./db/statusserviceimage.php" method="POST">
                              <div class="modal-header">
                                  <input type="hidden" name="uniqid" value="<?php echo $_GET['s']; ?>">
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
      $.post("./db/infoserviceimage.php",{ id: ""+id+"" }, function(data,status){ 
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