<?php
error_reporting(E_ALL ^ E_WARNING);
session_start();
if ($_SESSION['role'] != "Texas") {
	header("Location: ../index.php");
} else {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<?php include_once("../head.php"); ?>
		<style>
			.card-img-top {
				width: 100%;
				height: 40vh;
				object-fit: fill;
			}
		</style>
	</head>

	<body>
		<!-- NAVIGATION -->
		<?php
		$nav_role = "Branch";
		include_once("../nav.php"); ?>
		<!-- MAIN CONTENT -->
		<div class="main-content">
			<div class="header">
				<!-- HEADER -->
				<div class="header">
					<div class="container-fluid">
						<!-- Body -->
						<div class="header-body">
							<div class="row align-items-end">
								<div class="col">
									<h5 class="header-pretitle">
									<a class="btn-link btn-outline" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
								</h5>
									<h6 class="header-pretitle">
										Branch
									</h6>
									<!-- Title -->
									<h1 class="header-title">
										Profile
									</h1>
								</div>
							</div>
							<!-- / .row -->
						</div>
						<!-- / .header-body -->
					</div>
				</div>
				<!-- / .header -->
				<?php
				include_once("../config.php");
				$xbrid = $_GET['brid'];
				$xbrid = mysqli_real_escape_string($conn, $xbrid);
				$semid = $_GET['semid'];
				$semid = mysqli_real_escape_string($conn, $semid);
				$_SESSION["userrole"] = "Institute";
				if (isset($xbrid)) {
					$sql = "SELECT * FROM branchmaster WHERE BranchCode = '$xbrid'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
				?>
					<br><br>
					<div class="container-fluid">
						<!-- Body -->
						<div class="header-body mt-n5 mt-md-n6">
							<div class="row align-items-center">
								<div class="col mb-3 ml-n3 ml-md-n2">
									<h1 class="header-title">
										<?php echo $row['BranchName']; ?>
									</h1>
									<h5 class="header-pretitle mt-2">
										<?php echo $row['BranchCode']; ?>
									</h5>
								</div>
								<div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">
									<!-- Button -->
									<a href="edit_branch.php?brid=<?php echo $row['BranchId']; ?>" class="btn btn-warning d-block d-md-inline-block btn-md">
										Edit Details
									</a>
								</div>
							</div>
							<hr class="navbar-divider my-4">
							<!-- / .row -->
							<div class="row align-items-center">
								<div class="col col-md-10">
									<!-- Nav -->
									<ul class="nav nav-tabs nav-overflow header-tabs">
										<?php
										$a = 1;
										while ($a <= $row['BranchSemesters']) { ?>
											<li class="nav-item">
												<a href="sem_details.php?semid=<?php echo $row['BranchCode'] . "_" . $a; ?>&brid=<?php echo $row['BranchCode']; ?>" class="nav-link h3 <?php if ($_GET['semid'] == $row['BranchCode'] . "_" . $a) {
																																															echo "active";
																																														} ?>">
													Sem <?php echo $a; ?>
												</a>
											</li>
										<?php $a++;
										}
										?>
									</ul>
								</div>
								<div class=" col-md-auto mt-2 mt-md-0 mb-md-3">
									<!-- Nav -->
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="add_subject.php?semid=<?php echo $semid; ?>&brid=<?php echo $row['BranchCode']; ?>" type="button" class="btn btn-primary">
										Add Subject
									</a>
								</div>
							</div>
						</div>
						<!-- / .header-body -->
					</div>
			</div>
			<!-- CONTENT -->
			<div class="container-fluid">
				<div class="row">
					<?php
					$C = $_GET['semid'];
					$C = mysqli_real_escape_string($conn, $C);
					$subsql = "Select *, FacultyFirstName, FacultyLastname from subjectmaster INNER JOIN facultymaster on subjectmaster.SubjectFacultyId=facultymaster.FacultyId where SemCode = '$C'";
					$subresult = mysqli_query($conn, $subsql);
					$sac = 1;
					if (mysqli_num_rows($subresult) > 0) {
						while ($roww = mysqli_fetch_assoc($subresult)) { ?>
							<div class="col-12 col-md-4 mb-md-5">
								<div class="card-group">
									<div class="card">
										<img src="../src/uploads/subprofile/<?php echo $roww['SubjectPic']."?t"; ?>" class="card-img-top img-fluid" alt="...">
										<div class="card-body">
											<h5 class="card-title"><?php echo $roww['SubjectName']; ?></h5>
											<p class="card-text"><?php echo $roww['SubjectCode']; ?></p>
											<p class="card-text"><?php echo $roww['FacultyFirstName'] . " " . $roww['FacultyLastName']; ?></p>
											<a href="edit_subject.php?semid=<?php echo $semid; ?>&brid=<?php echo $xbrid; ?>&subcode=<?php echo $roww['SubjectCode']; ?>" class="btn btn-sm btn-warning">Edit</a> |
											<a class="btn btn-sm btn-danger" href="semsubdelete.php?subcode=<?php echo $roww['SubjectCode']; ?>&semid=<?php echo $semid; ?>&brid=<?php echo $xbrid; ?>" onclick="if (! confirm('Are you sure , you want to delete this subject ?')) return false;">
												Delete
												<!--changes-->
											</a>
										</div>
									</div>
								</div>
							</div>
						<?php
							$sac++;
						}
					} else { ?>
						<div class="col-12">
							<h1 class="card header-title m-5 p-5">No Subjects Added</h1>
						</div>
					<?php
					}
					?>
				</div>
			</div>
			<?php
				} else {
					$er = $_GET['brid'];
					$er = mysqli_real_escape_string($conn, $er);
					$qur = "SELECT * FROM branchmaster WHERE BranchCode = '$er';";
					$res = mysqli_query($conn, $qur);
					$row = mysqli_fetch_assoc($res);
					if (isset($row)) { ?>
				<div class="container-fluid">
					<hr class="navbar-divider my-4">
					<div class="card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col ml-n2">
									<h4 class="mb-1">
										<a href="branch_profile.php"><?php echo $row['BranchName']; ?></a>
									</h4>
									<p class="small mb-1">
										<?php echo $row['BranchCode']; ?>
									</p>
								</div>
								<div class="col-auto">
									<a href="branch_profile.php?brid=<?php echo $row['BranchId']; ?>" class="btn btn-m btn-primary d-none d-md-inline-block">
										View
									</a>
								</div>
							</div>
							<!-- / .row -->
						</div>
						<!-- / .card-body -->
					</div>
				</div>
		<?php
					}
				}
		?>
		</div>
		
		<!-- / .main-content -->
		<!-- JAVASCRIPT -->
		<!-- Map JS -->
		<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
		<!-- Vendor JS -->
		<script src="../assets/js/vendor.bundle.js"></script>
		<!-- Theme JS -->
		<script src="../assets/js/theme.bundle.js"></script>
	</body>

	</html>
<?php } ?>