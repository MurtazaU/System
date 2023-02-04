<!doctype html>
<html lang="en">
<?php
require '../constants/settings.php';
require 'constants/check-login.php';
require '../constants/db_config.php';

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$stmt = $conn->prepare("SELECT * FROM tbl_countries ORDER BY country_name");
	$stmt->execute();
	$result = $stmt->fetchAll();
} catch (PDOException $e) {
}


if ($user_online == "true") {
	if ($myrole == "employee") {
	} else {
		header("location:../");
	}
} else {
	header("location:../");
}
// Resume Upload
if (isset($_REQUEST['update-resume'])) {
	// File Variables
	$file_name = $_FILES['resume']['name'];
	$file_tmp = $_FILES['resume']['tmp_name'];

	// Moving File
	move_uploaded_file($file_tmp, "./resume/" . $file_name);

	$sql = $conn->prepare("UPDATE tbl_users SET resume = ? WHERE email = ?");
	$sql->bindParam(1, $file_name);
	$sql->bindParam(2, $myemail);

	$sql->execute();
}
?>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>JustEntryLevel Jobs - Employee Profile</title>

	<link rel="shortcut icon" href="../images/ico/favicon.png">

	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" media="screen">
	<link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/component.css" rel="stylesheet">

	<link rel="stylesheet" href="../icons/linearicons/style.css">
	<link rel="stylesheet" href="../icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../icons/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="../icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="../icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="../icons/rivolicons/style.css">
	<link rel="stylesheet" href="../icons/flaticon-line-icon-set/flaticon-line-icon-set.css">
	<link rel="stylesheet" href="../icons/flaticon-streamline-outline/flaticon-streamline-outline.css">
	<link rel="stylesheet" href="../icons/flaticon-thick-icons/flaticon-thick.css">
	<link rel="stylesheet" href="../icons/flaticon-ventures/flaticon-ventures.css">

	<link href="../css/style.css" rel="stylesheet">

</head>
<style>
	.autofit2 {
		height: 80px;
		width: 100px;
		object-fit: cover;
	}
</style>

<body class="not-transparent-header">

	<div class="container-wrapper">

		<header id="header">

			<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

				<div class="container">

					<div class="logo-wrapper">
						<div class="logo">
							<a href="../"><img src="../images/logo.png" alt="Logo" /></a>
						</div>
					</div>

					<div id="navbar" class="navbar-nav-wrapper navbar-arrow">

						<ul class="nav navbar-nav" id="responsive-menu">

							<li>

								<a href="../">Home</a>

							</li>

							<li>
								<a href="../job-list.php">Job List</a>

							</li>

						</ul>

					</div>

					<div class="nav-mini-wrapper">
						<ul class="nav-mini sign-in">
							<li><a href="../logout.php">logout</a></li>
							<li><a href="./">Profile</a></li>
						</ul>
					</div>

				</div>

				<div id="slicknav-mobile"></div>

			</nav>


		</header>


		<div class="admin-container-wrapper">

			<div class="container">

				<div class="GridLex-gap-15-wrappper">

					<div class="GridLex-grid-noGutter-equalHeight">

						<div class="GridLex-col-3_sm-4_xs-12">

							<div class="admin-sidebar">

								<div class="admin-user-item">
									<div class="image">

										<?php
										if ($myavatar == null) {
											print '<center><img class="img-circle autofit2" src="../images/default.jpg" title="' . $myfname . '" alt="image"  /></center>';
										} else {
											echo '<center><img class="img-circle autofit2" alt="image" title="' . $myfname . '"  src="data:image/jpeg;base64,' . base64_encode($myavatar) . '"/></center>';
										}
										?>
									</div>
									<br>


									<h4><?php echo "$myfname"; ?> <?php echo "$mylname"; ?></h4>
									<p class="user-role"><?php echo "$mytitle"; ?></p>

								</div>


								<ul class="admin-user-menu clearfix">
									<li class="active">
										<a href="./"><i class="fa fa-user"></i> CV / Profile</a>
									</li>
									<li class="">
										<a href="change-password.php"><i class="fa fa-key"></i> Change Password</a>
									</li>
								</ul>

							</div>

						</div>

						<div class="GridLex-col-9_sm-8_xs-12">

							<div class="admin-content-wrapper">

								<div class="admin-section-title">

									<h2>Profile</h2>

								</div>

								<form class="post-form-wrapper" action="app/update-profile.php" method="POST" autocomplete="off">

									<div class="row gap-20">
										<?php require 'constants/check_reply.php'; ?>

										<div class="clear"></div>

										<div class="col-sm-6 col-md-4">

											<div class="form-group">
												<label>First Name</label>
												<input name="fname" required type="text" class="form-control" value="<?php echo "$myfname"; ?>" placeholder="Enter your first name">
											</div>

										</div>

										<div class="col-sm-6 col-md-4">

											<div class="form-group">
												<label>Last Name</label>
												<input name="lname" required type="text" class="form-control" value="<?php echo "$mylname"; ?>" placeholder="Enter your last name">
											</div>

										</div>

										<div class="clear"></div>


										<div class="col-sm-12 col-md-8">

											<div class="form-group">
												<label>Email</label>
												<input type="email" name="email" required class="form-control" value="<?php echo "$myemail"; ?>" placeholder="Enter your email address">
											</div>

										</div>

										<div class="clear"></div>

										<div class="form-group">

											<div class="col-sm-12">
												<label>Education Level</label>
											</div>

											<div class="col-sm-6 col-md-4">
												<input value="<?php echo "$myedu"; ?>" name="education" type="text" required class="form-control" placeholder="Eg: Diploma, Degree...etc">
											</div>


											<div class="col-sm-6 col-md-4">
												<input value="<?php echo "$mytitle"; ?>" name="title" required type="text" class="form-control mb-15" placeholder="Eg: Computer Science, IT...etc">
											</div>

										</div>

										<div class="clear"></div>


										<div class="col-sm-12 col-md-8">

											<div class="form-group">
												<label>City/town</label>
												<input name="city" required type="text" class="form-control" value="<?php echo "$mycity"; ?>">
											</div>

										</div>

										<div class="clear"></div>


										<div class="col-sm-6 col-md-4">

											<div class="form-group">
												<label>Street</label>
												<input name="street" required type="text" class="form-control" value="<?php echo "$mystreet"; ?>">
											</div>

										</div>
										<div class="col-sm-6 col-md-4">

											<div class="form-group">
												<label>Zip Code</label>
												<input name="zip" required type="text" class="form-control" value="<?php echo "$myzip"; ?>">
											</div>

										</div>

										<div class="clear"></div>



										<div class="col-sm-6 col-md-4">

											<div class="form-group">
												<label>Country</label>
												<select name="country" required class="selectpicker show-tick form-control" data-live-search="true">
													<option disabled value="">Select</option>
													<?php
													foreach ($result as $row) {
													?> <option <?php if ($mycountry == $row['country_name']) {
																	print ' selected ';
																} ?> value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option> <?php

																																							} ?>

												</select>
											</div>

										</div>

										<div class="col-sm-6 col-md-4">

											<div class="form-group">
												<label>Phone Number</label>
												<input type="text" name="phone" required class="form-control" value="<?php echo "$myphone"; ?>">
											</div>

										</div>




										<div class="clear"></div>

										<div class="col-sm-12 col-md-12">

											<div class="form-group bootstrap3-wysihtml5-wrapper">
												<label>About me</label>
												<textarea name="about" class="bootstrap3-wysihtml5 form-control" placeholder="Enter your short description ..." style="height: 200px;"><?php echo "$mydesc"; ?></textarea>
											</div>

										</div>

										<div class="clear"></div>

										<div class="col-sm-12 mt-10">
											<button type="submit" class="btn btn-primary">Update</button>
											<button type="reset" class="btn btn-primary btn-inverse">Cancel</button>
										</div>

									</div>

								</form><br>

								<form method="POST" enctype="multipart/form-data">
									<div class="col-sm-12 col-md-12">

										<label>Your CV / Resume</label>
										<input class="form-control" accept=".pdf, .docx, text/plain" type="file" name="resume" required>
										<div class="col-sm-12 mt-10">
											<button type="submit" class="btn btn-primary" name="update-resume">Update</button>
										</div>
									</div>
								</form>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>
		<footer class="footer-wrapper">
			<div class="main-footer">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-9">
							<div class="row">
								<div class="col-sm-6 col-md-5 mt-30-xs">
									<h5 class="footer-title">Quick Links</h5>
									<ul class="footer-menu clearfix">
										<li><a href="./">Home</a></li>
										<li><a href="job-list.php">Job List</a></li>
										<li><a href="#">Go to top</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bottom-footer">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-12 text-center">
							<p class="copy-right">&#169; Copyright <?php echo date('Y'); ?> Jobs.JustEntryLevel</p>
						</div>
					</div>
				</div>
			</div>
		</footer>

	</div>

	</div>



	<div id="back-to-top">
		<a href="#"><i class="ion-ios-arrow-up"></i></a>
	</div>


	<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../js/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-modalmanager.js"></script>
	<script type="text/javascript" src="../js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="../js/smoothscroll.js"></script>
	<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="../js/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="../js/wow.min.js"></script>
	<script type="text/javascript" src="../js/jquery.slicknav.min.js"></script>
	<script type="text/javascript" src="../js/jquery.placeholder.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-tokenfield.js"></script>
	<script type="text/javascript" src="../js/typeahead.bundle.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap3-wysihtml5.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="../js/jquery-filestyle.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-select.js"></script>
	<script type="text/javascript" src="../js/ion.rangeSlider.min.js"></script>
	<script type="text/javascript" src="../js/handlebars.min.js"></script>
	<script type="text/javascript" src="../js/jquery.countimator.js"></script>
	<script type="text/javascript" src="../js/jquery.countimator.wheel.js"></script>
	<script type="text/javascript" src="../js/slick.min.js"></script>
	<script type="text/javascript" src="../js/easy-ticker.js"></script>
	<script type="text/javascript" src="../js/jquery.introLoader.min.js"></script>
	<script type="text/javascript" src="../js/jquery.responsivegrid.js"></script>
	<script type="text/javascript" src="../js/customs.js"></script>


</body>



</html>