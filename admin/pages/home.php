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
$mydbcolumnsstr = "home_about_id > ? AND home_about_active = ?";
$mydbarray = [0,1];
$resultAbout = $dbcon->dbslca("home_about",$mydbcolumnsstr,$mydbarray);

//TAKE MENU DATA
$mydbcolumnsstr = "floki_id > ? AND floki_lang = ?";
$mydbarray = [0,$langnumaber];
$result = $dbcon->dbslca("floki",$mydbcolumnsstr,$mydbarray);

$myreturndata = [];
foreach ($resultLang as $key2 => $value2) {
	foreach ($resultAbout as $key => $value) {
		if($value["home_about_lang"] == $value2["lang_id"]){
			$myreturndata[$value2["lang_id"]]["home_about_title"] = $value["home_about_title"];
			$myreturndata[$value2["lang_id"]]["home_about_text"] = $value["home_about_text"];
			$myreturndata[$value2["lang_id"]]["home_about_file"] = $value["home_about_file"];
			$myreturndata[$value2["lang_id"]]["home_about_button"] = $value["home_about_button"];
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
										<i class="icon-home"></i>
									</div>
									<div class="page-title">
										<h5>Home Settings</h5>
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
									<div class="card-header">Home</div>
										<div class="card-body">
										<form action="./db/home.php" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="id" value="<?php echo $resultAbout[0]["home_about_id"] ?>">
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
														<label for="input1" class="col-form-label">Home About Title</label>
														<input type="text" required value="<?php echo $myreturndata[$valuelang['lang_id']]["home_about_title"] ?>" name="title-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Home About Title">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Home About Text</label>
														<input type="text" required value="<?php echo $myreturndata[$valuelang['lang_id']]["home_about_text"] ?>" name="text-<?php echo $valuelang['lang_id'] ?>" class="form-control" id="input1" placeholder="Home About Text">
													</div>
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Home About Current Image</label>
														<hr>
														<img src="./uploads/<?php echo $myreturndata[$valuelang['lang_id']]["home_about_file"] ?>" alt="tr">
													</div>
													<input type="hidden" name="oldfile<?php echo $valuelang['lang_id']; ?>" value="<?php echo $myreturndata[$valuelang['lang_id']]["home_about_file"] ?>">
													<div class="form-group col-md-12">
														<label for="input1" class="col-form-label">Home About New Image</label>
														<hr>
														<input type="file" name="file-<?php echo $valuelang['lang_id'] ?>" id="file2">
														<hr>
													</div>
												</div>	
											</div>
										<?php }  ?>
										<button type="submit" class="btn btn-primary">Set Home About</button>   
										</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										Floki Item List
									</div>
									<div class="card-body">
									<table id="basicExample" class="table table-striped table-bordered">
										<thead>
										<tr>
											<th>Name</th>
                                            <th>Icon</th>
                                            <th>Text</th>
											<th>Actions</th>
										</tr>
										</thead>
										<tbody>
										<?php if($result == false){ }else{ foreach($result as $key => $value){ ?>
																<tr>
											<td><?php echo $value['floki_name']; ?></td>
                                            <td><?php echo $value['floki_icon']; ?></td>
                                            <td><?php echo $value['floki_text']; ?></td>
											<td><?php echo $value['floki_date']; ?></td>
											<td>
												<button class="btn btn-info btn-rounded"  data-toggle="modal" data-target="#cogModal" onclick="setFunc('<?php echo $value["floki_id"]; ?>')" ><i class="icon-settings" style="color:white"></i></button>
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

                  <!-- Set Modal -->
                  <div class="modal fade" id="cogModal" tabindex="-1" role="dialog" aria-labelledby="cogModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <form action="./db/setfloki.php" method="POST"  enctype="multipart/form-data">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="cogModalLabel">Set Floki Item Form</h5>
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
                                        <label for="input1" class="col-form-label">Floki Item Name</label>
                                        <input type="text" required name="name-<?php echo $valuelang['lang_id'] ?>"  class="form-control" id="name-<?php echo $valuelang['lang_id'] ?>" placeholder="Floki Item Name">
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Floki Item Text</label>
                                        <input type="text" required name="text-<?php echo $valuelang['lang_id'] ?>"  class="form-control" id="name-<?php echo $valuelang['lang_id'] ?>" placeholder="Floki Item Text">
                                      </div>
                                      <div class="form-group col-md-12">
                                        <label for="input1" class="col-form-label">Floki Item Icon</label>
                                        <input type="text" required name="icon-<?php echo $valuelang['lang_id'] ?>"  class="form-control" id="name-<?php echo $valuelang['lang_id'] ?>" placeholder="Floki Item Icon">
                                      </div>
                                    </div>
                                  </div>
                                  <?php } ?>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Set Floki Item</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
<script>
    function setFunc(id){
      $.post("./db/infofloki.php",{ id: ""+id+"" }, function(data,status){ 
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
</script>