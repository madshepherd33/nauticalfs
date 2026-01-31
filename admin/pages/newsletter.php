<?php 

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//LOGIN CONTROL
$mydbcolumnsstr = "mail_list_id > ? and mail_list_active = ?";
$mydbarray = [0,1];
$result = $dbcon->dbslca("mail_list",$mydbcolumnsstr,$mydbarray);


?>
                <!-- BEGIN .app-main -->
                <div class="app-main">
					<!-- BEGIN .main-heading -->
					<header class="main-heading">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
									<div class="page-icon">
										<i class="icon-input-checked"></i>
									</div>
									<div class="page-title">
										<h5>Newsletters</h5>
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
                                        Newsletter List
                                    </div>
									<div class="card-body">
										<table id="basicExample" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Name</th>
													<th>Date</th>
                                                    <th>Actions</th>
												</tr>
											</thead>
											<tbody>
                                                <?php if($result == false){ }else{ foreach ($result as $key => $value) { ?>
												<tr>
													<td><?php echo $value['mail_list_name']; ?></td>
													<td><?php echo $value['mail_list_date']; ?></td>
													<td>
                                                        <button class="btn btn-danger btn-rounded"  data-toggle="modal" data-target="#delModal" onclick="delFunc('<?php echo $value["mail_list_id"]; ?>','<?php echo $value["mail_list_name"]; ?>')" ><i class="icon-trash" style="color:white"></i></button>
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
                        <form action="./db/delmaillist.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delModalLabel">Delete Newsletter Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                    <input type="hidden" id="delid" name="id">
                                    <p>Are you sure delete <b id="delname"></b>  ?</p>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete Newsletter</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>



<script>
    function delFunc(id,name){
        document.getElementById("delid").value = id;
        document.getElementById("delname").innerHTML = name;
    }
</script>