<?php 

//DB CONNECTION
$dbcon = new MyDB();
$dbcon->connect_initial();
$db = $dbcon->db();

//LOGIN CONTROL
$mydbcolumnsstr = "admin_menu_id > ? and admin_menu_active = ? and admin_menu_show = ? ORDER BY admin_menu_order ASC";
$mydbarray = [0, 1, 1];
$result = $dbcon->dbslca("admin_menu",$mydbcolumnsstr,$mydbarray);
if ($p == "login") {
}else{
?>
		<!-- BEGIN .app-wrap -->
        <div class="app-wrap">
			<!-- BEGIN .app-heading -->
			<header class="app-header">
				<div class="container-fluid">
					<div class="row gutters">
						<div class="col-xl-5 col-lg-5 col-md-5 col-sm-3 col-4">
							<a class="mini-nav-btn" href="#" id="app-side-mini-toggler">
								<i class="icon-menu5"></i>
							</a>
							<a href="#app-side" data-toggle="onoffcanvas" class="onoffcanvas-toggler" aria-expanded="true">
								<i class="icon-chevron-thin-left"></i>
							</a>
						</div>
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-4">
							<a href="index.php" class="logo">
								<img src="img/logo.png" alt="AAB SYSTEM DASHBOARD" />
							</a>
						</div>
						<div class="col-xl-5 col-lg-5 col-md-5 col-sm-3 col-4">
							<ul class="header-actions">
                                <!--
								<li class="dropdown">
									<a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
										<i class="icon-notifications_none"></i>
										<span class="count-label"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right lg" aria-labelledby="notifications">
										<ul class="imp-notify">
											<li>
												<div class="icon">W</div>
												<div class="details">
													<p><span>Wilson</span> The best Dashboard design I have seen ever.</p>
												</div>
											</li>
										</ul>
									</div>
								</li>
								<li>
                                    <a href="#" id="todos" data-toggle="dropdown" aria-haspopup="true">
                                        <i class="icon-person_outline"></i>
                                        <span class="count-label red"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right lg" aria-labelledby="todos">
                                        <ul class="stats-widget">
                                        <li>
                                            <h4>$37895</h4>
                                            <p>Revenue <span>+2%</span></p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%">
                                                    <span class="sr-only">87% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
								</li>
                                -->
								<li class="dropdown">
									<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
										<img class="avatar" src="./uploads/<?php echo $_SESSION['user_image_url']; ?>" alt="User Thumb" />
										<span class="user-name"><?php echo $_SESSION['user_name']; ?></span>
										<i class="icon-chevron-small-down"></i>
									</a>
									<div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
										<ul class="user-settings-list">
											<li>
												<a href="./index.php?f=profile">
													<div class="icon">
														<i class="icon-account_circle"></i>
													</div>
													<p>Profile</p>
												</a>
											</li>
											<li>
												<a href="./db/logout.php">
													<div class="icon red">
														<i class="icon-lock"></i>
													</div>
													<p>Logout</p>
												</a>
											</li>
										</ul>
										<div class="logout-btn">
											<a href="./db/logout.php" class="btn btn-primary">Logout</a>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</header>
			<!-- END: .app-heading -->
			<!-- BEGIN .app-container -->
			<div class="app-container">
				<!-- BEGIN .app-side -->
				<aside class="app-side" id="app-side">
					<!-- BEGIN .side-content -->
					<div class="side-content ">
						<!-- BEGIN .user-profile -->
						<div class="user-profile">
							<img src="./uploads/<?php echo $_SESSION['user_image_url']; ?>" class="profile-thumb" alt="User Thumb">
							<h6 class="profile-name"><?php echo $_SESSION['user_name']; ?></h6>
						    <!--
                            <ul class="profile-actions">
								<li>
									<a href="#">
										<i class="icon-social-skype"></i>
										<span class="count-label red"></span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="icon-social-twitter"></i>
									</a>
								</li>
								<li>
									<a href="login.html">
										<i class="icon-export"></i>
									</a>
								</li>
							</ul>
						</div>
                        -->
						<!-- END .user-profile -->
						<!-- BEGIN .side-nav -->
						<nav class="side-nav">
							<!-- BEGIN: side-nav-content -->
							<ul class="unifyMenu" id="unifyMenu">
								<?php foreach ($result as $key => $value) { ?>
                                <li>
									<a href="index.php?f=<?php echo $value['admin_menu_url']; ?>">
										<span class="has-icon">
											<i class="<?php echo $value['admin_menu_icon']; ?>"></i>
										</span>
										<span class="nav-title"><?php echo $value['admin_menu_name']; ?></span>
									</a>
								</li>
								<?php } ?>
                                
							</ul>
							<!-- END: side-nav-content -->
						</nav>
						<!-- END: .side-nav -->
					</div>
					<!-- END: .side-content -->
				</aside>
				<!-- END: .app-side -->
<?php } ?>