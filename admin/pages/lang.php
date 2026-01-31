<?php 

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//LOGIN CONTROL
$mydbcolumnsstr = "lang_id > ?";
$mydbarray = [0];
$result = $dbcon->dbslca("lang",$mydbcolumnsstr,$mydbarray);


?>
                <!-- BEGIN .app-main -->
                <div class="app-main">
					<!-- BEGIN .main-heading -->
					<header class="main-heading">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
									<div class="page-icon">
										<i class="icon-earth"></i>
									</div>
									<div class="page-title">
										<h5>Language Settings</h5>
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
                                        Language List
                                        <button type="button" class="btn  btn-success" style="float:right"  data-toggle="modal" data-target="#addModal"><i class="icon-plus"></i> New Language</button>
                                    </div>
									<div class="card-body">
										<table id="basicExample" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Name</th>
													<th>Flag</th>
													<th>Active</th>
													<th>Date</th>
                                                    <th>Actions</th>
												</tr>
											</thead>
											<tbody>
                                                <?php if($result == false){ }else{ foreach ($result as $key => $value) { ?>
												<tr>
													<td><?php echo $value['lang_name']; ?></td>
													<td><img style="width:50px;" src="./uploads/<?php echo $value['lang_flag']; ?>" alt="flag-<?php echo $value['lang_name']; ?>"></td>
													<td>
                                                        <?php if($value['lang_active'] == 1){?>
                                                            <span class="badge badge-pill badge-success">Active</span>
                                                        <?php }else{ ?>
                                                            <span class="badge badge-pill badge-warning">Passive</span>
                                                        <?php } ?>
                                                    </td>
													<td><?php echo $value['lang_date']; ?></td>
													<td>
                                                        <?php if($value['lang_active'] == 1){?>
                                                            <button class="btn btn-warning btn-rounded"  data-toggle="modal" data-target="#pasModal" onclick="pasFunc('<?php echo $value["lang_id"]; ?>','<?php echo $value["lang_name"]; ?>')" ><i class="icon-star" style="color:white"></i></button>
                                                        <?php }else{ ?>
                                                            <button class="btn btn-success btn-rounded"  data-toggle="modal" data-target="#activeModal" onclick="actFunc('<?php echo $value["lang_id"]; ?>','<?php echo $value["lang_name"]; ?>')" ><i class="icon-star" style="color:white"></i></button>
                                                        <?php } ?>
                                                        <button class="btn btn-info btn-rounded"  data-toggle="modal" data-target="#cogModal" onclick="setFunc('<?php echo $value["lang_id"]; ?>','<?php echo $value["lang_name"]; ?>','<?php echo "./uploads/".$value["lang_flag"]; ?>')" ><i class="icon-settings" style="color:white"></i></button>
                                                        <button class="btn btn-danger btn-rounded"  data-toggle="modal" data-target="#delModal" onclick="delFunc('<?php echo $value["lang_id"]; ?>','<?php echo $value["lang_name"]; ?>')" ><i class="icon-trash" style="color:white"></i></button>
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
                            <form action="./db/addlang.php" method="POST"  enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">New Language Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Language Name</label>
                                        <input type="text" required name="name" class="form-control" id="input1" placeholder="Language Name">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Language Flag</label>
                                        <input required type="file" name="file" id="file2">
                                    </div>
                                </div>
                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Add Language</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Set Modal -->
                <div class="modal fade" id="cogModal" tabindex="-1" role="dialog" aria-labelledby="cogModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form action="./db/setlang.php" method="POST"  enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cogModalLabel">Set Language Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="setname" class="col-form-label">Language Name</label>
                                            <input type="text" required name="name" class="form-control" id="setname" placeholder="Language Name">
                                        </div>
                                        <input type="hidden" name="setid" id="setid">
                                        <hr>
                                        <img src="./uploads/flags/tr.png" id="setflag" alt="" style="width:100px;height:75px" />
                                        <hr>
                                        <div class="form-group col-md-12">
                                            <label for="input1" class="col-form-label">Language New Flag</label>
                                            <input type="file" name="file" id="file2">
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Set Language</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <!-- Del Modal -->
                <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form action="./db/dellang.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delModalLabel">Delete Language Form</h5>
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
                                <button type="submit" class="btn btn-danger">Delete Language</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!-- Passive Modal -->
                <div class="modal fade" id="pasModal" tabindex="-1" role="dialog" aria-labelledby="pasModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form action="./db/statuslang.php" method="POST">
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
                        <form action="./db/statuslang.php" method="POST">
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
    function setFunc(id,name,url){
        document.getElementById("setid").value = id;
        document.getElementById("setname").value = name;
        document.getElementById("setflag").src = url;
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