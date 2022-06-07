<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
if ($_SESSION['role'] != "Texas") {
    header("Location: ../index.php");
} else {
    include_once "../config.php";
    $_SESSION["userrole"] = "Institute";

    $uqur = "SELECT * FROM updatemaster";
    $ures = mysqli_query($conn, $uqur);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "../head.php"; ?>
</head>

<body>
    <!-- NAVIGATION -->
    <?php
    $nav_role = "Updates";
    include_once "../nav.php"; ?>
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <!-- Header -->
                    <div class="header">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="header-pretitle">
                                        <a class="btn-link btn-outline" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
                                    </h5>
                                    <h6 class="header-pretitle">
                                        View
                                    </h6>
                                    <!-- Title -->

                                    <h1 class="header-title text-truncate">
                                        Updates List
                                    </h1>
                                </div>
                                <div class="col-auto">
                                    <a href="add_update.php" class="btn btn-primary ml-2">
                                        Add Update
                                    </a>
                                </div>
                            </div>
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                    <li class="nav-item">
                                        <a href="#!" class="nav-link text-nowrap active">
                                            All Updates <span class="badge rounded-pill bg-soft-secondary"><?php echo mysqli_num_rows($ures); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">
                        <!-- Card -->
                        <div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 10, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <!-- Form -->
                                        <form  autocomplete="off">
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
                                                <a class="list-sort text-muted" data-sort="item-score">No.</a>
                                            </th>
                                            <th>
                                                <a class="list-sort text-muted" data-sort="item-phone">Date</a>
                                            </th>
                                            <th>
                                                <a class="list-sort text-muted" data-sort="item-name">Title</a>
                                            </th>
                                            <th>
                                                <a class="list-sort text-muted" data-sort="item-company">Uploaded By</a>
                                            </th>
                                            <th>
                                                <a class="text-muted">Info</a>
                                            </th>
                                            <th>
                                                <a class="text-muted justify-content-center">Action</a>
                                            </th>
                                            <th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="list font-size-base">
                                        <?php
                                        $a = 1;
                                        while ($urow = mysqli_fetch_assoc($ures)) { ?>
                                            <tr>
                                                <td>
                                                    <span class="item-score"><?php echo $a++; ?></span>
                                                </td>
                                                <td>
                                                    <span class="item-phone"><?php echo $urow['UpdateUploadDate']; ?></span>
                                                </td>
                                                <td>
                                                    <!-- Text -->
                                                    <span class="item-name"><?php echo $urow['UpdateTitle']; ?></span>
                                                </td>
                                                <td>
                                                    <span class="item-company"><?php echo $urow['UpdateUploadedBy']; ?></span>
                                                </td>
                                                <td>
                                                    <!-- Phone -->
                                                    <a href="update_profile.php?updateid=<?php echo $urow['UpdateId']; ?>" type="button" class="btn btn-sm btn-info">View</a>
                                                </td>
                                                <td>
                                                    <!-- Badge -->
                                                    <a href="edit_update.php?updid=<?php echo $urow['UpdateId']; ?>" type="button" class="btn btn-sm btn-warning">Edit</a> &nbsp;
                                                    <!-- Badge -->
                                                    <a download="<?php echo $urow['UpdateFile']; ?>" href="../src/uploads/updates/<?php echo $urow['UpdateFile']; ?>" type="button" class="btn btn-sm btn-success">Download</a>
                                                </td>
                                                <td></td>
                                            <tr id="demo1" class="collapse">
                                                <td colspan="6" class="hiddenRow">
                                                    <div>Demo1</div>
                                                </td>
                                            </tr>
                                            </tr>
                                        <?php } ?>
                                        <!--over-->
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <!-- Pagination (prev) -->
                                <ul class="list-pagination-prev pagination pagination-tabs card-pagination">
                                    <li class="page-item">
                                        <a class="page-link pl-0 pr-4 border-right" href="#">
                                            <i class="fe fe-arrow-left mr-1"></i> Prev
                                        </a>
                                    </li>
                                </ul>
                                <!-- Pagination -->
                                <ul class="list-pagination pagination pagination-tabs card-pagination">
                                    <li class="active"><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">1</a></li>
                                    <li><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">2</a></li>
                                    <li><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">3</a></li>
                                </ul>
                                <!-- Pagination (next) -->
                                <ul class="list-pagination-next pagination pagination-tabs card-pagination">
                                    <li class="page-item">
                                        <a class="page-link pl-4 pr-0 border-left" href="#">
                                            Next <i class="fe fe-arrow-right ml-1"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- / .main-content -->
    <!-- JAVASCRIPT -->
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <!-- Vendor JS -->
    <script src="../assets/js/vendor.bundle.js"></script>
    <!-- Theme JS -->
    <script src="../assets/js/theme.bundle.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>