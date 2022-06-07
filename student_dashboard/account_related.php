<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
if ($_SESSION['role'] != "Abuja") {
	header("Location: ../index.php");
} else {
	include_once("../config.php");
	$_SESSION["userrole"] = "Student";

	$un = $_SESSION['id'];
	$stuqry = "SELECT * FROM studentmaster WHERE StudentUserName = '$un'";
	$sturesult = mysqli_fetch_assoc(mysqli_query($conn, $stuqry));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
	<!-- Favicon -->
	<link rel="shortcut icon" href="../assets/favicon/favicon.ico" type="image/x-icon" />
	<!-- Map CSS -->
	<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" />
	<!-- Libs CSS -->
	<link rel="stylesheet" href="../assets/css/libs.bundle.css" />
	<!-- Theme CSS -->
	<link rel="stylesheet" href="../assets/css/theme.bundle.css" />
	<!-- Title -->
	<title>LMS by Titanslab</title>
</head>

<body>
	<!-- NAVIGATION -->
	<?php
	$nav_role = "Account related Details";
	include_once('nav.php'); ?>
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-10 col-xl-8">
					<!-- Header -->
					<div class="header mt-md-5">
						<div class="header-body">
							<div class="row align-items-center">
								<div class="col">
									<h5 class="header-pretitle">
										<a class="btn-link btn-outline" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
									</h5>
									<h6 class="header-pretitle">
										New Request
									</h6>
									<!-- Title -->
									<h1 class="header-title">
										Account Query
									</h1>
								</div>
							</div>
							<!-- / .row -->
						</div>
					</div>
					<form method="POST" autocomplete="off" class="row g-3 needs-validation" >
						<div class="form-group">
							<!-- Label  -->
							<label class="form-label">
								Your Name
							</label>
							<!-- Input -->
							<input type="text" value="<?php echo $sturesult['StudentFirstName'] . " " . $sturesult['StudentLastName']; ?>" name="arname" class="form-control" readonly>
						</div>
						<!-- Project description -->
						<div class="form-group">
							<!-- Label -->
							<label class="form-label">
								Detail
								<small class="form-text text-muted">
									Enter details you want to edit
								</small>
							</label>
							<textarea id="demo" rows="4" class="form-control fs-2" name="ardetails" required></textarea>
						</div>
						<hr class="mt-3">
						<!-- Buttons -->
						<input class="btn btn-block btn-primary mb-5" type="submit" name="sub">
					</form>
				</div>
			</div>
			<!-- / .row -->
		</div>
	</div>
	<!-- / .main-content -->
	</div>
	</div> <!-- / .row -->
	</div>
	</div><!-- / .main-content -->
	<!-- JAVASCRIPT -->
	<!-- Map JS -->
	<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
	<!-- Vendor JS -->
	<script src="../assets/js/vendor.bundle.js"></script>
	<!-- Theme JS -->
	<script src="../assets/js/theme.bundle.js"></script>
	<?php include("context.php"); ?>
</body>

</html>

<?php

if (isset($_POST['sub'])) {

	$qrdetails = $_POST['ardetails'];
	$qrfrom = $sturesult['StudentId'];

	$qrstatus = 1;
	$dt = date('Y-m-d');

	$qrtopic = "Account Related Help";
	$sql = "INSERT INTO `accountquerymaster`(`QueryTopic`,`QueryFromId`, `QueryQuestion`, `Querystatus`, `QueryGenDate`)
	VALUES ('$qrtopic','$qrfrom','$qrdetails','$qrstatus','$dt')";
	$run = mysqli_query($conn, $sql);
	if ($run == true) {
		echo "<script>alert('Request Sent .. ')</script>";
		echo "<script>window.open('query_list.php','_self')</script>";
	} else {
		echo "<script>alert('Error to Send Request .. ')</script>";
		echo "<script>window.open('account_related.php','_self')</script>";
	}
}
?>