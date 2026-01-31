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
$mydbcolumnsstr = "slider_id > ? AND slider_lang = ?";
$mydbarray = [0,$langnumaber];
$result = $dbcon->dbslca("slider",$mydbcolumnsstr,$mydbarray);

?>
                <!-- BEGIN .app-main -->
                <div class="app-main">
					<!-- BEGIN .main-heading -->
					<header class="main-heading">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
									<div class="page-icon">
										<i class="icon-equalizer"></i>
									</div>
									<div class="page-title">
										<h5>Slider List</h5>
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
                                        Slider List
                                        <button type="button" class="btn  btn-success" style="float:right"  data-toggle="modal" data-target="#addModal"><i class="icon-plus"></i> New Slider</button>
                                    </div>
									<div class="card-body">
										<table id="basicExample" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Title</th>
                          <th>File</th>
													<th>Active</th>
													<th>Date</th>
                          <th>Actions</th>
												</tr>
											</thead>
											<tbody>
                        <?php if($result == false){ }else{ foreach($result as $key => $value){ ?>
												<tr>
													<td><?php echo $value['slider_title']; ?></td>
													<td><img src="./uploads/<?php echo $value['slider_file']; ?>" style="width:50px;" alt="<?php echo $value['slider_title']; ?>"></td>                            
													<td>
                              <?php if($value['slider_active'] == 1){?>
                                  <span class="badge badge-pill badge-success">Active</span>
                              <?php }else{ ?>
                                  <span class="badge badge-pill badge-warning">Passive</span>
                              <?php } ?>
                          </td>
													<td><?php echo $value['slider_date']; ?></td>
													<td>
                              <?php if($value['slider_active'] == 1){?>
                              <button class="btn btn-warning btn-rounded"  data-toggle="modal" data-target="#pasModal" onclick="pasFunc('<?php echo $value["slider_id"]; ?>','<?php echo $value["slider_title"]; ?>')" ><i class="icon-star" style="color:white"></i></button>
                              <?php }else{ ?>
                              <button class="btn btn-success btn-rounded"  data-toggle="modal" data-target="#activeModal" onclick="actFunc('<?php echo $value["slider_id"]; ?>','<?php echo $value["slider_title"]; ?>')" ><i class="icon-star" style="color:white"></i></button>
                              <?php } ?>
                              <button class="btn btn-info btn-rounded"  data-toggle="modal" data-target="#cogModal" onclick="setFunc('<?php echo $value["slider_id"]; ?>')" ><i class="icon-settings" style="color:white"></i></button>
                              <button class="btn btn-danger btn-rounded"  data-toggle="modal" data-target="#delModal" onclick="delFunc('<?php echo $value["slider_id"]; ?>','<?php echo $value["slider_title"]; ?>')" ><i class="icon-trash" style="color:white"></i></button>
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
                            <form action="./db/addslider.php" method="POST"  enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">New Slider Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php foreach ($resultLang as $keylang => $valuelang) { ?>
                                <?php if($keylang == 0){ ?> 
                                <li class="nav-item">
                                  <a class="nav-link active" id="<?php echo $valuelang['lang_name'] ?>-tab" data-toggle="tab" href="#<?php echo $valuelang['lang_name'] ?>" role="tab" aria-controls="<?php echo $valuelang['lang_name'] ?>" aria-selected="true"><img src="<?php echo "./uploads/".$valuelang['lang_flag'] ?>" style="width:30px" alt="<?php echo "flag".$valuelang['lang_name'] ?>"></a>
                                </li>
                                <?php }else{ ?> 
                                <li class="nav-item">
                                  <a class="nav-link" id="<?php echo $valuelang['lang_name'] ?>-tab" data-toggle="tab" href="#<?php echo $valuelang['lang_name'] ?>" role="tab" aria-controls="<?php echo $valuelang['lang_name'] ?>" aria-selected="true"><img src="<?php echo "./uploads/".$valuelang['lang_flag'] ?>" style="width:30px" alt="<?php echo "flag".$valuelang['lang_name'] ?>"></a>
                                </li>
                                <?php } } ?>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                <?php foreach ($resultLang as $keylang => $valuelang) { ?>
                                <?php if($keylang == 0){ ?> 
                                <div class="tab-pane fade show active" id="<?php echo $valuelang['lang_name'] ?>" role="tabpanel" aria-labelledby="<?php echo $valuelang['lang_name'] ?>-tab">
                                  <div class="form-row">
                                    <div class="form-group col-md-12">
                                      <label for="input1" class="col-form-label">Slider Title</label>
                                      <input type="text" required name="title-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Slider Title">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="input1" class="col-form-label">Slider File</label>
                                      <hr>
                                      <input type="file" required name="file-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1">
                                      <hr>
                                    </div>
                                  </div>
                                </div>
                                <?php }else{ ?> 
                                <div class="tab-pane fade show" id="<?php echo $valuelang['lang_name'] ?>" role="tabpanel" aria-labelledby="<?php echo $valuelang['lang_name'] ?>-tab">
                                  <div class="form-row">
                                    <div class="form-group col-md-12">
                                      <label for="input1" class="col-form-label">Slider Title</label>
                                      <input type="text" required name="title-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Slider Title">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="input1" class="col-form-label">Slider File</label>
                                      <hr>
                                      <input type="file" required name="file-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1">
                                      <hr>
                                    </div>
                                  </div>
                                </div>
                                <?php } } ?>
                              </div>                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Add Slider</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Set Modal -->
                <div class="modal fade" id="cogModal" tabindex="-1" role="dialog" aria-labelledby="cogModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form action="./db/setslider.php" method="POST"  enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cogModalLabel">Set Slider Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <input type="hidden" id="setid" name="id">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php foreach ($resultLang as $keylang => $valuelang) { ?>
                                <?php if($keylang == 0){ ?> 
                                <li class="nav-item">
                                  <a class="nav-link active" id="set<?php echo $valuelang['lang_name'] ?>-tab" data-toggle="tab" href="#set<?php echo $valuelang['lang_name'] ?>" role="tab" aria-controls="<?php echo $valuelang['lang_name'] ?>" aria-selected="true"><img src="<?php echo "./uploads/".$valuelang['lang_flag'] ?>" style="width:30px" alt="<?php echo "flag".$valuelang['lang_name'] ?>"></a>
                                </li>
                                <?php }else{ ?> 
                                <li class="nav-item">
                                  <a class="nav-link" id="set<?php echo $valuelang['lang_name'] ?>-tab" data-toggle="tab" href="#set<?php echo $valuelang['lang_name'] ?>" role="tab" aria-controls="<?php echo $valuelang['lang_name'] ?>" aria-selected="true"><img src="<?php echo "./uploads/".$valuelang['lang_flag'] ?>" style="width:30px" alt="<?php echo "flag".$valuelang['lang_name'] ?>"></a>
                                </li>
                                <?php } } ?>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                <?php foreach($resultLang as $keylang => $valuelang){ ?>
                                <?php if($keylang == 0){ ?> 
                                <div class="tab-pane fade show active" id="set<?php echo $valuelang['lang_name'] ?>" role="tabpanel" aria-labelledby="set<?php echo $valuelang['lang_name'] ?>-tab">
                                  <div class="form-row">
                                    <div class="form-group col-md-12">
                                      <label for="input1" class="col-form-label">Slider Title</label>
                                      <input type="text" required name="title-<?php echo $valuelang['lang_id'] ?>"  class="form-control" id="title-<?php echo $valuelang['lang_id'] ?>" placeholder="Menu Name">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="input1" class="col-form-label">Current File</label>
                                      <hr>
                                      <img src="awf" alt="<?php echo $valuelang['lang_name'] ?>" id="file-<?php echo $valuelang['lang_id'] ?>" style="width:100%" >
                                      <hr>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="input1" class="col-form-label">New File</label>
                                      <hr>
                                      <input type="file" required name="file-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1">
                                      <hr>
                                    </div>
                                  </div>
                                </div>
                                <?php }else{ ?> 
                                <div class="tab-pane fade" id="set<?php echo $valuelang['lang_name'] ?>" role="tabpanel" aria-labelledby="set<?php echo $valuelang['lang_name'] ?>-tab">
                                  <div class="form-row">
                                    <div class="form-group col-md-12">
                                      <label for="input1" class="col-form-label">Slider Title</label>
                                      <input type="text" required name="title-<?php echo $valuelang['lang_id'] ?>"  class="form-control" id="title-<?php echo $valuelang['lang_id'] ?>" placeholder="Menu Name">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="input1" class="col-form-label">Current File</label>
                                      <hr>
                                      <img src="awf" alt="<?php echo $valuelang['lang_name'] ?>" id="file-<?php echo $valuelang['lang_id'] ?>" style="width:100%">
                                      <hr>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="input1" class="col-form-label">New File</label>
                                      <hr>
                                      <input type="file" required name="file-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1">
                                      <hr>
                                    </div>
                                  </div>
                                </div>
                                <?php } } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Set Slider</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <!-- Del Modal -->
                <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form action="./db/delslider.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delModalLabel">Delete Slider Form</h5>
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
                                <button type="submit" class="btn btn-danger">Delete Slider</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!-- Passive Modal -->
                <div class="modal fade" id="pasModal" tabindex="-1" role="dialog" aria-labelledby="pasModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form action="./db/statusslider.php" method="POST">
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
                        <form action="./db/statusslider.php" method="POST">
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
      $.post("./db/infoslider.php",{ id: ""+id+"" }, function(data,status){ 
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
    function delFunc(id,name){
        document.getElementById("delid").value = id;
        document.getElementById("delname").value = name;
    }
    function pasFunc(id,name){
        document.getElementById("pasid").value = id;
        document.getElementById("pasname").value = name;
    }
    function actFunc(id,name){
        document.getElementById("actid").value = id;
        document.getElementById("actname").value = name;
    }
</script>