<?php 

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//LANG CONTROL
$mydbcolumnsstr = "lang_id > ? AND lang_active = ?";
$mydbarray = [0,1];
$resultLang = $dbcon->dbslca("lang",$mydbcolumnsstr,$mydbarray);

//LANG CONTROL
$mydbcolumnsstr = "contact_info_id > ? AND contact_info_active = ?";
$mydbarray = [0,1];
$resultAbout = $dbcon->dbslca("contact_info",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($resultLang as $key2 => $value2) {
	foreach ($resultAbout as $key => $value) {
		if($value["contact_info_lang"] == $value2["lang_id"]){
			$myreturndata[$value2["lang_id"]]["contact_info_phone_one"] = $value["contact_info_phone_one"];
			$myreturndata[$value2["lang_id"]]["contact_info_mail"] = $value["contact_info_mail"];
			$myreturndata[$value2["lang_id"]]["contact_info_gmap"] = $value["contact_info_gmap"];
			$myreturndata[$value2["lang_id"]]["contact_info_adres"] = $value["contact_info_adres"];
			$myreturndata[$value2["lang_id"]]["contact_info_wp_number"] = $value["contact_info_wp_number"];
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
										<i class="icon-phone"></i>
									</div>
									<div class="page-title">
										<h5>Contact Information Settings</h5>
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
									<div class="card-header">Contact Information</div>
										<div class="card-body">
										<form action="./db/contactinfo.php" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="id" value="<?php echo $resultAbout[0]["contact_info_id"] ?>">
											<ul class="nav nav-tabs" id="myTab" role="tablist">
											<?php foreach ($resultLang as $keylang => $valuelang) { ?>
											<li class="nav-item">
												<a class="nav-link <?php if($keylang == 0){ echo 'active'; }else{} ?>" id="<?php echo $valuelang['lang_name'] ?>-tab" data-toggle="tab" href="#<?php echo $valuelang['lang_name'] ?>" role="tab" aria-controls="<?php echo $valuelang['lang_name'] ?>" aria-selected="true"><img src="<?php echo "./uploads/".$valuelang['lang_flag'] ?>" style="width:30px" alt="<?php echo "flag".$valuelang['lang_name'] ?>"></a>
											</li>
											<?php } ?>
											</ul>
											<div class="tab-content" id="myTabContent">
											<?php foreach ($resultLang as $keylang => $valuelang) { ?>
											<div class="tab-pane fade show  <?php if($keylang == 0){ echo 'active'; }else{} ?>" id="<?php echo $valuelang['lang_name'] ?>" role="tabpanel" aria-labelledby="<?php echo $valuelang['lang_name'] ?>-tab">
												<div class="form-row">
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Phone Number</label>
														<input type="text" required value="<?php if(isset($myreturndata[$valuelang['lang_id']])){ echo $myreturndata[$valuelang['lang_id']]["contact_info_phone_one"]; }else{} ?>" name="phone-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Our Phone Number">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">WhatsApp Number</label>
														<input type="text" required value="<?php if(isset($myreturndata[$valuelang['lang_id']])){ echo $myreturndata[$valuelang['lang_id']]["contact_info_wp_number"]; }else{} ?>" name="wp-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Our WhatsApp Number">
													</div>
                                                    <div class="form-group col-md-12">
														<label for="input1" class="col-form-label">E-Mail Address</label>
														<input type="text" required value="<?php if(isset($myreturndata[$valuelang['lang_id']])){ echo $myreturndata[$valuelang['lang_id']]["contact_info_mail"]; }else{} ?>" name="mail-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Our E-Mail Address">
													</div>
                                                    <div class="form-group col-md-12">
														<label for="input1" class="col-form-label">GMAP Link</label>
														<input type="text" required value="<?php if(isset($myreturndata[$valuelang['lang_id']])){ echo $myreturndata[$valuelang['lang_id']]["contact_info_gmap"]; }else{} ?>" name="gmap-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Our GMAP Link">
													</div>
                                                    <div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Address</label>
														<input type="text" required value="<?php if(isset($myreturndata[$valuelang['lang_id']])){ echo $myreturndata[$valuelang['lang_id']]["contact_info_adres"]; }else{} ?>" name="adres-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Our Address">
													</div>
												</div>	
											</div>
										<?php } ?>
										<button type="submit" class="btn btn-primary">Set Contact Information</button>   
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
