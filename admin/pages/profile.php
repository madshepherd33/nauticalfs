
<!-- BEGIN .app-main -->
<div class="app-main">
    <!-- BEGIN .main-heading -->
    <header class="main-heading">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <div class="page-icon">
                        <i class="icon-user-tie"></i>
                    </div>
                    <div class="page-title">
                        <h5>User Profile</h5>
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
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                <a class="block-300 center-text">
                    <div class="user-profile">
                        <img src="./uploads/<?php echo $_SESSION['user_image_url']; ?>" class="profile-thumb" alt="<?php echo $_SESSION['user_name']; ?>">
                        <h5 class="profile-name"><?php echo $_SESSION['user_name']; ?></h5>
                        <h6 class="profile-designation"><?php echo $_SESSION['user_mail']; ?></h6>
                        <p class="profile-location"><?php echo $_SESSION['user_phone']; ?></p>
                    </div>
                </a>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                <div class="card">
                    <div class="card-header">User Information</div>
                        <div class="card-body">
                            <form action="./db/profile.php" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="input1" class="col-form-label">User Name</label>
                                    <input type="text" required name="name" class="form-control" id="input1" placeholder="User Name" value="<?php echo $_SESSION['user_name']; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="input1" class="col-form-label">User Nickname</label>
                                    <input type="text" required name="nick" class="form-control" id="input1" placeholder="User Nickname" value="<?php echo $_SESSION['user_nick']; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="input1" class="col-form-label">User E-Mail Address</label>
                                    <input type="email" required name="mail" class="form-control" id="input1" placeholder="User E-Mail Address" value="<?php echo $_SESSION['user_mail']; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="input1" class="col-form-label">User Phone Number</label>
                                    <input type="text" required name="phone" class="form-control" id="input1" placeholder="User Phone Number" value="<?php echo $_SESSION['user_phone']; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="input1" class="col-form-label">User Password</label>
                                    <input type="password" required name="pass" class="form-control" id="input1" placeholder="User Password" value="<?php echo $_SESSION['user_pass']; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="input1" class="col-form-label">New User Profile Image</label>
                                    <hr>
                                    <input type="file" name="file" id="file2">
                                    <hr>
                                </div>
                                <button type="submit" class="btn btn-primary">Set User Information</button>   
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>