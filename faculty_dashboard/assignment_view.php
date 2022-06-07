<?php
error_reporting(E_ALL ^ E_WARNING);
session_start();
if ($_SESSION['role'] != "Lagos") {
	header("Location: ../index.php");
} else {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<?php include_once "../head.php"; ?>
	</head>

	<body>
		<?php $nav_role = "Assignment"; ?>
		<!-- NAVIGATION -->
		<?php include_once 'nav.php'; ?>
		<!-- MAIN CONTENT -->
		<div class="main-content">
			<div class="container-fluid">
				<div class="header-body">
					<div class="row align-items-end">
						<div class="col">
							<h5 class="header-pretitle">
								<a class="btn-link btn-outline" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
							</h5>
							<h1 class="header-title">
								Assignment
							</h1>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-12	">
						<br>
						<?php
						include_once "../config.php";
						$ttid = $_GET['updateid'];
						$ttid = mysqli_real_escape_string($conn, $ttid);
						$_SESSION["userrole"] = "Faculty";
						if (isset($ttid)) {
							$sql = "SELECT * FROM assignmentmaster INNER JOIN subjectmaster ON assignmentmaster.AssignmentSubject = subjectmaster.SubjectCode WHERE AssignmentId = '$ttid'";
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_assoc($result);

							$asql = "SELECT * FROM studentassignment INNER JOIN studentmaster ON studentassignment.SAssignmentUploaderId = studentmaster.StudentId WHERE AssignmentId = '$ttid';";
							$aresult = mysqli_query($conn, $asql);

						?>
							<div class="card">
								<div class="card-body">
									<h3 class="header-title">
										<?php echo $row['AssignmentTitle']; ?> Info:
									</h3>
									<br>
									<div class="input-group">
										<span class="input-group-text col-3 ">Title</span>
										<input type="text" value="<?php echo $row['AssignmentTitle']; ?>" aria-label="First name" class="form-control" disabled>
										<span class="input-group-text col-3 ">Subject</span>
										<input type="text" value="<?php echo $row['SubjectName']; ?>" aria-label="Last name" class="form-control disable" disabled>
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-text col-3 ">Upload date</span>
										<input type="text" value="<?php echo $row['AssignmentUploaddate']; ?>" aria-label="First name" class="form-control" disabled>
										<span class="input-group-text col-3 ">Submission Date</span>
										<input type="text" value="<?php echo $row['AssignmentSubmissionDate']; ?>" aria-label="Last name" class="form-control disable" disabled>
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-text col-3 ">Description</span>
										<textarea aria-label="First name" class="form-control" disabled><?php echo $row['AssignmentDesc']; ?></textarea>
									</div>
									<div class="d-flex justify col-3 mt-3">
										<!-- Button -->
										<a href="../src/uploads/assignments/<?php echo $row['AssignmentFile']; ?>" download="<?php echo $row['AssignmentFile']; ?>" class="btn btn-success" name="Download">
											Download
										</a>
									</div>
								</div>
							</div>
					</div>
				</div>
				<hr class="navbar-divider my-4 mt-20">
			</div>
			<!-- CONTENT -->
			<!-- Tab content -->
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-12">
						<div class="header">
							<div class="header-body">
								<div class="row align-items-center">
									<div class="col">
										<ul class="nav nav-tabs nav-overflow header-tabs">
											<li class="nav-item">
												<a href="#" class="nav-link text-nowrap active">
													Assignment Submissions <span class="badge rounded-pill bg-soft-secondary"><?php echo mysqli_num_rows($aresult); ?></span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php if (mysqli_num_rows($aresult) > 0) { ?>
							<div class="tab-content">
								<div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">
									<!-- Card -->
									<div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 10, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
										<div class="card-header">
											<div class="row align-items-center">
												<div class="col">
													<!-- Form -->
													<form autocomplete="off">
														<div class="input-group input-group-flush input-group-merge input-group-reverse">
															<input class="form-control list-search" type="search" placeholder="Search">
															<span class="input-group-text">
																<i class="fe fe-search"></i>
															</span>
														</div>
													</form>
												</div>
												<div class="col-auto">
												</div>
											</div>
											<!-- / .row -->
										</div>
										<div class="table-responsive">
											<table class="table table-sm table-hover table-nowrap card-table">
												<thead>
													<tr>
														<th>
															<a class="list-sort text-muted" data-sort="item-name">No</a>
														</th>
														<th>
															<a class="list-sort text-muted" data-sort="item-name">Student Name</a>
														</th>
														<th>
															<a class="list-sort text-muted" data-sort="item-score">Assignment Status</a>
														</th>
														<th>
															<a class="list-sort text-muted" data-sort="item-phone">Upload Date</a>
														</th>
														<th>
															<a class="list-sort text-muted justify-content-center">Action</a>
														</th>
													</tr>
												</thead>
												<tbody class="list font-size-base">
													<?php
													$a++;
													while ($row = mysqli_fetch_assoc($aresult)) { ?>
														<tr>
															<td>
																<span class="text-reset item-score"><?php echo $a++; ?></span>
															</td>
															<td>
																<span type="text" class="text-reset item-name"><?php echo $row['StudentFirstName']; ?> <?php echo $row['StudentLastName']; ?></span>
															</td>
															<td>
																<?php
																$a = $row['SAssignmentStatus'];
																if ($a == 0) {
																?>
																	<span class="badge bg-soft-primary">New</span>
																<?php
																} else if ($a == 1) {
																?>
																	<span class="badge bg-soft-success">Submited</span>
																<?php
																} else if ($a == 2) {
																?>
																	<span class="badge bg-soft-warning">Rejected</span>
																<?php
																} else if ($a == 3) {
																?>
																	<span class="badge bg-soft-warning">Completed</span>
																<?php
																}
																?>
															</td>
															<td>
																<!-- Email -->
																<span type="text" class="text-reset item-phone" name="bsem" required><?php echo $row['SAssignmentUploadDate']; ?></span>
															</td>
															<td>
																<a href="assign_status.php?upid=<?php echo $row['SAssignmentUploaderId']; ?>&asid=<?php echo $ttid; ?>&a=<?php echo 1; ?>" class="btn btn-sm btn-danger">
																	Reject
																</a>
																&nbsp;
																<a class="btn btn-sm btn-success" href="assign_status.php?upid=<?php echo $row['SAssignmentUploaderId']; ?>&asid=<?php echo $ttid; ?>&a=<?php echo 2; ?>">
																	Complete
																	<!--changes-->
																</a>
																&nbsp;
																<a href="../src/uploads/studentAssignment/<?php echo $row['SAssignmentFile']; ?>" download="<?php echo $row['SAssignmentFile']; ?>" class="btn btn-sm btn-info" name="Download">
																	Download
																</a>
															</td>
														</tr>
													<?php } ?>
													<!--over-->
											</table>
										</div>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="col-12">
								<h1 class="card header-title m-5 p-5"> Oops, No Submissions To Show</h1>
							</div>
					<?php }
						} ?>
					</div>
				</div>
			</div>
			<?php include("context.php"); ?>
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