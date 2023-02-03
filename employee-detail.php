<!doctype html>
<html lang="en">
<?php
require 'constants/settings.php';
require 'constants/check-login.php';
require 'constants/db_config.php';
if (isset($_GET['empid'])) {
	$empid = $_GET['empid'];

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE role = 'employee' AND member_no = :empid");
		$stmt->bindParam(':empid', $empid);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$rec = count($result);
		if ($rec == "0") {
			header("location:./");
		} else {

			foreach ($result as $row) {
				$myfname = $row['first_name'];
				$mylname = $row['last_name'];
				$bdate = $row['bdate'];
				$bmonth = $row['bmonth'];
				$byear = $row['byear'];
				$mycountry = $row['country'];
				$mycity = $row['city'];
				$myphone = $row['phone'];
				$about = $row['about'];
				$empavatar = $row['avatar'];
				$current_year = date('Y');
				$myedu = $row['education'];
				$mytitle = $row['title'];
				$mymail = $row['email'];
				$myresume = $row['resume'];
			}
		}
	} catch (PDOException $e) {
	}
} else {
	header("location:./");
}

if (isset($_REQUEST['download-resume'])) {
	echo $myresume;
	$filename = $myresume;

	header("Content-type: application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document");

	header("Content-Disposition: attachment; filename=$filename");

	readfile("./employee/resume/$filename");
};

?>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>JustEntryLevel Jobs - <?php echo "$myfname"; ?> <?php echo "$mylname"; ?></title>

	<link rel="shortcut icon" href="images/ico/favicon.png">

	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="images/ico/favicon.png">

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/component.css" rel="stylesheet">

	<link rel="stylesheet" href="icons/linearicons/style.css">
	<link rel="stylesheet" href="icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="icons/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="icons/rivolicons/style.css">
	<link rel="stylesheet" href="icons/flaticon-line-icon-set/flaticon-line-icon-set.css">
	<link rel="stylesheet" href="icons/flaticon-streamline-outline/flaticon-streamline-outline.css">
	<link rel="stylesheet" href="icons/flaticon-thick-icons/flaticon-thick.css">
	<link rel="stylesheet" href="icons/flaticon-ventures/flaticon-ventures.css">

	<link href="css/style.css" rel="stylesheet">


</head>

<style>
	.autofit2 {
		height: 110px;
		width: 120px;
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
							<a href="./"><img src="images/logo.png" alt="Logo" /></a>
						</div>
					</div>

					<div id="navbar" class="navbar-nav-wrapper navbar-arrow">

						<ul class="nav navbar-nav" id="responsive-menu">

							<li>

								<a href="./">Home</a>

							</li>

							<li>
								<a href="job-list.php">Job List</a>

							</li>


						</ul>

					</div>

					<div class="nav-mini-wrapper">
						<ul class="nav-mini sign-in">
							<?php
							if ($user_online == true) {
								print '
						    <li><a href="logout.php">logout</a></li>
							<li><a href="' . $myrole . '">Profile</a></li>';
							} else {
								print '
							<li><a href="login.php">login</a></li>
							<li><a data-toggle="modal" href="#registerModal">register</a></li>';
							}

							?>

						</ul>
					</div>

				</div>

				<div id="slicknav-mobile"></div>

			</nav>

			<div id="registerModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-center">Create your account for free</h4>
				</div>

				<div class="modal-body">

					<div class="row gap-20">


						<div class="col-sm-12 col-md-12">
							<a href="register.php?p=Employee" class="btn btn-facebook btn-block mb-5-xs">Register as Employee</a>
						</div>

					</div>

				</div>

				<div class="modal-footer text-center">
					<button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
				</div>

			</div>


		</header>


		<div class="main-wrapper">

			<div class="breadcrumb-wrapper">

				<div class="container">

					<ol class="breadcrumb-list booking-step">
						<li><a href="employees.php">All Employees</a></li>
						<li><span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?></span></li>
					</ol>

				</div>

			</div>

			<div class="section sm">

				<div class="container">

					<div class="row">

						<div class="col-md-10 col-md-offset-1">

							<div class="employee-detail-wrapper">

								<div class="employee-detail-header text-center">

									<div class="image">
										<?php
										if ($empavatar == null) {
											print '<center><img class="img-circle autofit2" src="images/default.jpg"  alt="image"  /></center>';
										} else {
											echo '<center><img class="img-circle autofit2" alt="image" src="data:image/jpeg;base64,' . base64_encode($empavatar) . '"/></center>';
										}
										?>
									</div>

									<h2 class="heading mb-15"><?php echo "$myfname"; ?> <?php echo "$mylname"; ?></h2>

									<p class="location"><i class="fa fa-map-marker"></i> <?php echo "$mycountry"; ?>, <?php echo "$mycity"; ?><span class="mh-5">|</span> <i class="fa fa-phone"></i> <?php echo "$myphone"; ?></p>


									<ul class="meta-list clearfix">
										<li>
											<h4 class="heading">Birth Day:</h4>
											<?php echo "$bdate"; ?>/<?php echo "$bmonth"; ?>/<?php echo "$byear"; ?>
										</li>

										<li>
											<h4 class="heading">Education:</h4>
											<?php echo "$myedu"; ?> in <?php echo "$mytitle"; ?>
										</li>
										<li>
											<h4 class="heading">Email: </h4>
											<?php echo "$mymail"; ?>
										</li>
									</ul>

								</div>

								<div class="employee-detail-company-overview mt-40 clearfix">

									<h3>Introduce my self</h3>

									<p><?php echo "$about"; ?></p>

									<form method="POST">
										<button class="btn btn-primary" name="download-resume">
											Download Resume
										</button>
									</form>

								</div>

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

	<div id="back-to-top">
		<a href="#"><i class="ion-ios-arrow-up"></i></a>
	</div>

	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
	<script type="text/javascript" src="js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="js/smoothscroll.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="js/wow.min.js"></script>
	<script type="text/javascript" src="js/jquery.slicknav.min.js"></script>
	<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-tokenfield.js"></script>
	<script type="text/javascript" src="js/typeahead.bundle.min.js"></script>
	<script type="text/javascript" src="js/bootstrap3-wysihtml5.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="js/jquery-filestyle.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-select.js"></script>
	<script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
	<script type="text/javascript" src="js/handlebars.min.js"></script>
	<script type="text/javascript" src="js/jquery.countimator.js"></script>
	<script type="text/javascript" src="js/jquery.countimator.wheel.js"></script>
	<script type="text/javascript" src="js/slick.min.js"></script>
	<script type="text/javascript" src="js/easy-ticker.js"></script>
	<script type="text/javascript" src="js/jquery.introLoader.min.js"></script>
	<script type="text/javascript" src="js/jquery.responsivegrid.js"></script>
	<script type="text/javascript" src="js/customs.js"></script>


</body>

</html>