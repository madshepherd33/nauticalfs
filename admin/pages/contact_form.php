<?php 

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//LOGIN CONTROL
$mydbcolumnsstr = "contact_form_id > ? and contact_form_active = ?";
$mydbarray = [0,1];
$result = $dbcon->dbslca("contact_form",$mydbcolumnsstr,$mydbarray);


?>
                <!-- BEGIN .app-main -->
                <div class="app-main">
					<!-- BEGIN .main-heading -->
					<header class="main-heading">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
									<div class="page-icon">
										<i class="icon-envelope"></i>
									</div>
									<div class="page-title">
										<h5>Contact Forms</h5>
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
                                        Contact Form
                                    </div>
									<div class="card-body">
										<table id="basicExample" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Name</th>
													<th>Mail Address</th>
                                                    <th>Phone Number</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
													<th>Status</th>
													<th>Date</th>
                                                    <th>Actions</th>
												</tr>
											</thead>
											<tbody>
                                                <?php if($result == false){ }else{ foreach ($result as $key => $value) { ?>
												<tr>
													<td><?php echo $value['contact_form_name']; ?></td>
                                                    <td><?php echo $value['contact_form_mail']; ?></td>
                                                    <td><?php echo $value['contact_form_phone']; ?></td>
                                                    <td><?php echo $value['contact_form_subject']; ?></td>
                                                    <td><button class="btn btn-primary btn-rounded"  data-toggle="modal" data-target="#readModal" onclick="readFunc('<?php echo $value["contact_form_id"]; ?>')" >Read</button></td>
													<td>
                                                        <?php if($value['contact_form_status'] == 0){?>
                                                            <span class="badge badge-pill badge-success">Waiting</span>
                                                        <?php }else{ ?>
                                                            <span class="badge badge-pill badge-warning">Opened</span>
                                                        <?php } ?>
                                                    </td>
													<td><?php echo $value['contact_form_date']; ?></td>
													<td>
                                                        <button class="btn btn-danger btn-rounded"  data-toggle="modal" data-target="#delModal" onclick="delFunc('<?php echo $value["contact_form_id"]; ?>')" ><i class="icon-trash" style="color:white"></i></button>
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


                <!-- Del Modal -->
                <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form action="./db/delcontactform.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delModalLabel">Delete Form</h5>
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
                                <button type="submit" class="btn btn-danger">Delete Form</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!-- Passive Modal -->
                <div class="modal fade" id="readModal" tabindex="-1" role="dialog" aria-labelledby="readModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="readtitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="readid" name="id">
                                <p><b>Name : </b><span id="readname"></span></p>
                                <p><b>E-Mail Address : </b><span id="readmail"></span></p>
                                <p><b>Phone Number : </b><span id="readphone"></span></p>
                                <p><b>Subject : </b><span id="readsubject"></span></p>
                                <p><b>Date : </b><span id="readdate"></span></p>
                                <p><b>Message : </b></p>
                                <p id="readmessage"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>



<script>
    function delFunc(id){
        document.getElementById("delid").value = id;
    }
    function readFunc(id){
      $.post("./db/infocontactform.php",{ id: ""+id+"" }, function(data,s){ 
        obj = JSON.parse(data);
        Object.keys(obj).forEach(function(key) {
            if(key != "status"){
                if(key == "subject"){
                    document.getElementById("readtitle").innerHTML = "Read "+obj[key]+" Form";
                }
                var mykey = "read"+key;
                document.getElementById(mykey).innerHTML = obj[key];
            }
        });
      });
      $.post("./db/infocontactformm.php",{ id: ""+id+"" }, function(data,s){ 
        
      });
    }
</script>