<?php 

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//LANG CONTROL
$mydbcolumnsstr = "lang_id > ? AND lang_active = ?";
$mydbarray = [0,1];
$resultLang = $dbcon->dbslca("lang",$mydbcolumnsstr,$mydbarray);
$langnumaber = $resultLang[0]['lang_id'];
//LANG CONTROL
$mydbcolumnsstr = "our_approach_id > ? AND our_approach_active = ?";
$mydbarray = [0,1];
$resultAbout = $dbcon->dbslca("our_approach",$mydbcolumnsstr,$mydbarray);

//TAKE MENU DATA
$mydbcolumnsstr = "vission_id > ? AND vission_lang = ?";
$mydbarray = [0,$langnumaber];
$result = $dbcon->dbslca("vission",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($resultLang as $key2 => $value2) {
	foreach ($resultAbout as $key => $value) {
		if($value["our_approach_lang"] == $value2["lang_id"]){
			$myreturndata[$value2["lang_id"]]["our_approach_title"] = $value["our_approach_title"];
			$myreturndata[$value2["lang_id"]]["our_approach_text"] = $value["our_approach_text"];
			$myreturndata[$value2["lang_id"]]["our_approach_m_title"] = $value["our_approach_m_title"];
			$myreturndata[$value2["lang_id"]]["our_approach_m_text"] = $value["our_approach_m_text"];
			$myreturndata[$value2["lang_id"]]["our_approach_m_image"] = $value["our_approach_m_image"];
			$myreturndata[$value2["lang_id"]]["our_approach_v_title"] = $value["our_approach_v_title"];
			$myreturndata[$value2["lang_id"]]["our_approach_v_text"] = $value["our_approach_v_text"];
			$myreturndata[$value2["lang_id"]]["our_approach_v_image"] = $value["our_approach_v_image"];
			$myreturndata[$value2["lang_id"]]["our_approach_s_title"] = $value["our_approach_s_title"];
			$myreturndata[$value2["lang_id"]]["our_approach_s_text"] = $value["our_approach_s_text"];
			$myreturndata[$value2["lang_id"]]["our_approach_s_image"] = $value["our_approach_s_image"];
		}
	}
}


?>

        <!-- BEGIN .app-main -->
        <div class="app-main">
					<!-- BEGIN .main-heading -->
					<header class="main-heading">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
									<div class="page-icon">
										<i class="icon-office"></i>
									</div>
									<div class="page-title">
										<h5>About Us Settings</h5>
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
									<div class="card-header">About Us</div>
										<div class="card-body">
										<form action="./db/aboutus.php" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="id" value="<?php echo $resultAbout[0]["our_approach_id"] ?>">
											<ul class="nav nav-tabs" id="myTab" role="tablist">
											<?php foreach ($resultLang as $keylang => $valuelang) { ?>
											<li class="nav-item">
												<a class="nav-link <?php if($keylang == 0){ echo 'active'; } ?>" id="<?php echo $valuelang['lang_name'] ?>-tab" data-toggle="tab" href="#<?php echo $valuelang['lang_name'] ?>" role="tab" aria-controls="<?php echo $valuelang['lang_name'] ?>" aria-selected="true"><img src="<?php echo "./uploads/".$valuelang['lang_flag'] ?>" style="width:30px" alt="<?php echo "flag".$valuelang['lang_name'] ?>"></a>
											</li>
											<?php } ?>
											</ul>
											<div class="tab-content" id="myTabContent">
											<?php foreach ($resultLang as $keylang => $valuelang) { ?>
											<div class="tab-pane fade show  <?php if($keylang == 0){ echo 'active'; } ?>" id="<?php echo $valuelang['lang_name'] ?>" role="tabpanel" aria-labelledby="<?php echo $valuelang['lang_name'] ?>-tab">
												<div class="form-row">
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">About Us Title</label>
														<input type="text" required value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_title"] ?>" name="title-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="About Us Title">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">About Us Text</label>
														<input type="text" required value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_text"] ?>" name="text-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="About Us Title">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Sub About Us Title</label>
														<input type="text" required value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_s_title"] ?>" name="stitle-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="About Us Title">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Sub About Us Text</label>
														<input type="text" required value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_s_text"] ?>" name="stext-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="About Us Title">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Sub About Us Current Image</label>
														<hr>
														<img src="./uploads/<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_s_image"] ?>" alt="tr">
													</div>
													<input type="hidden" name="oldsfile<?php echo $valuelang['lang_id']; ?>" value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_s_image"] ?>">
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Sub About Us New Image</label>
														<hr>
														<input type="file" name="sfile-<?php echo $valuelang['lang_id'] ?>" id="file2">
														<hr>
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Mission Title</label>
														<input type="text" required value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_m_title"] ?>" name="mtitle-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="About Us Title">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Mission Text</label>
														<input type="text" required value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_m_text"] ?>" name="mtext-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="About Us Title">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Mission Current Image</label>
														<hr>
														<img src="./uploads/<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_m_image"] ?>" alt="tr">
													</div>
													<input type="hidden" name="oldmfile<?php echo $valuelang['lang_id']; ?>" value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_m_image"] ?>">
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Mission New Image</label>
														<hr>
														<input type="file" name="mfile-<?php echo $valuelang['lang_id'] ?>" id="file2">
														<hr>
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Vission Title</label>
														<input type="text" required value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_v_title"] ?>" name="vtitle-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="About Us Title">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Vission Text</label>
														<input type="text" required value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_v_text"] ?>" name="vtext-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="About Us Title">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Vission Current Image</label>
														<hr>
														<img src="./uploads/<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_v_image"] ?>" alt="tr">
													</div>
													<input type="hidden" name="oldvfile<?php echo $valuelang['lang_id']; ?>" value="<?php echo $myreturndata[$valuelang['lang_id']]["our_approach_v_image"] ?>">
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Vission New Image</label>
														<hr>
														<input type="file" name="vfile-<?php echo $valuelang['lang_id'] ?>" id="file2">
														<hr>
													</div>
												</div>	
											</div>
										<?php }  ?>
										<button type="submit" class="btn btn-primary">Set About Us</button>   
										</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										Vission Item List
										<button type="button" class="btn  btn-success" style="float:right"  data-toggle="modal" data-target="#addModal"><i class="icon-plus"></i> New Vission Item</button>
									</div>
									<div class="card-body">
									<table id="basicExample" class="table table-striped table-bordered">
										<thead>
										<tr>
											<th>Name</th>
											<th>Active</th>
											<th>Date</th>
											<th>Actions</th>
										</tr>
										</thead>
										<tbody>
										<?php if($result == false){ }else{ foreach($result as $key => $value){ ?>
																<tr>
											<td><?php echo $value['vission_name']; ?></td>
											<td>
												<?php if($value['vission_active'] == 1){?>
													<span class="badge badge-pill badge-success">Active</span>
												<?php }else{ ?>
													<span class="badge badge-pill badge-warning">Passive</span>
												<?php } ?>
											</td>
											<td><?php echo $value['vission_date']; ?></td>
											<td>
												<?php if($value['vission_active'] == 1){?>
												<button class="btn btn-warning btn-rounded"  data-toggle="modal" data-target="#pasModal" onclick="pasFunc('<?php echo $value["vission_id"]; ?>')" ><i class="icon-star" style="color:white"></i></button>
												<?php }else{ ?>
												<button class="btn btn-success btn-rounded"  data-toggle="modal" data-target="#activeModal" onclick="actFunc('<?php echo $value["vission_id"]; ?>')" ><i class="icon-star" style="color:white"></i></button>
												<?php } ?>
												<button class="btn btn-info btn-rounded"  data-toggle="modal" data-target="#cogModal" onclick="setFunc('<?php echo $value["vission_id"]; ?>')" ><i class="icon-settings" style="color:white"></i></button>
												<button class="btn btn-danger btn-rounded"  data-toggle="modal" data-target="#delModal" onclick="delFunc('<?php echo $value["vission_id"]; ?>')" ><i class="icon-trash" style="color:white"></i></button>
											</td>
																</tr>
										<?php } } ?>
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Add Modal -->
				<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <form action="./db/addvission.php" method="POST"  enctype="multipart/form-data">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="addModalLabel">New Vission Form</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                  <?php foreach ($resultLang as $keylang => $valuelang) { ?> 
                                  <li class="nav-item">
                                    <a class="nav-link <?php if($keylang == 0){ echo 'active'; } ?>" id="<?php echo $valuelang['lang_name'] ?>-tab" data-toggle="tab" href="#add<?php echo $valuelang['lang_name'] ?>" role="tab" aria-controls="<?php echo $valuelang['lang_name'] ?>" aria-selected="true"><img src="<?php echo "./uploads/".$valuelang['lang_flag'] ?>" style="width:30px" alt="<?php echo "flag".$valuelang['lang_name'] ?>"></a>
                                  </li>
                                  <?php } ?>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                  <?php foreach ($resultLang as $keylang => $valuelang) { ?>
                                  <div class="tab-pane fade show <?php if($keylang == 0){ echo 'active'; } ?>" id="add<?php echo $valuelang['lang_name'] ?>" role="tabpanel" aria-labelledby="<?php echo $valuelang['lang_name'] ?>-tab">
                                    <div class="form-row">
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Vission Name</label>
                                        <input type="text" required name="name-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Vission Name">
                                      </div>
                                    </div>
                                  </div>
                                  <?php } ?> 
                                </div>                            
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success">Add Vission</button>
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>

                  <!-- Set Modal -->
                  <div class="modal fade" id="cogModal" tabindex="-1" role="dialog" aria-labelledby="cogModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/setvission.php" method="POST"  enctype="multipart/form-data">
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
                                        <label for="input1" class="col-form-label">Vission Name</label>
                                        <input type="text" required name="name-<?php echo $valuelang['lang_id'] ?>"  class="form-control" id="name-<?php echo $valuelang['lang_id'] ?>" placeholder="Vission Name">
                                      </div>
                                    </div>
                                  </div>
                                  <?php } ?>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Set Vission</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                  <!-- Del Modal -->
                  <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/delvission.php" method="POST">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="delModalLabel">Delete Vission Form</h5>
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
                                  <button type="submit" class="btn btn-danger">Delete Vission</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>

                  <!-- Passive Modal -->
                  <div class="modal fade" id="pasModal" tabindex="-1" role="dialog" aria-labelledby="pasModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/statusvission.php" method="POST">
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
                          <form action="./db/statusvission.php" method="POST">
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
      $.post("./db/infovission.php",{ id: ""+id+"" }, function(data,status){ 
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