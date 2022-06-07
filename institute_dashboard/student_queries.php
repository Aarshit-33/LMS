<?php
session_start();
if ($_SESSION['role'] != "Texas") {
    header("Location: ../index.php");
} else {
    include_once("../config.php");
    $_SESSION["userrole"] = "Faculty";
    $qur = "SELECT *, StudentFirstName, StudentLastName FROM accountquerymaster INNER JOIN studentmaster on accountquerymaster.QueryFromId = studentmaster.StudentId";

    $res = mysqli_query($conn, $qur);

    $squr = "SELECT * FROM studentmaster";
    $sres = mysqli_query($conn, $squr);
    $srow = mysqli_fetch_array($sres);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../head.php"); ?>
</head>

<body>
    <!-- NAVIGATION -->
    <?php
    $nav_role = "Student Queries";
    include_once("../nav.php"); ?>
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
                                        Query List
                                    </h1>
                                </div>
                            </div>
                            <!-- / .row -->
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Nav -->
                                    <ul class="nav nav-tabs nav-overflow header-tabs">
                                        <li class="nav-item">
                                            <a href="#!" class="nav-link text-nowrap active">
                                                All Query <span class="badge rounded-pill bg-soft-secondary"><?php echo mysqli_num_rows($res); ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab content -->
                    <div class="main-content">
                        <div class="">
                            <div class="row justify-content-center">
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
                                                <table class="table table-sm table-hover table-nowrap card-table" id="myTable">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <a class="list-sort text-muted" data-sort="item-name">#</a>
                                                            </th>
                                                            <th>
                                                                <a class="list-sort text-muted" data-sort="item-email" href="#">From</a>
                                                            </th>
                                                            <th>
                                                                <a class="list-sort text-muted" data-sort="item-phone" href="#">Status</a>
                                                            </th>
                                                            <th colspan="2">
                                                                <a class="list-sort text-muted" data-sort="item-company" href="#">Action</a>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list font-size-base">
                                                        <?php
                                                        $c = 1;
                                                        while ($urow = mysqli_fetch_assoc($res)) { ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $c++; ?>
                                                                </td>
                                                                <td>
                                                                    <!-- Text -->
                                                                    <span class="item-title"><?php echo $urow['StudentFirstName'] . " " . $urow['StudentLastName']; ?></span>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $a = $urow['Querystatus'];
                                                                    if ($a == 1) {
                                                                    ?>
                                                                        <span class="badge bg-soft-primary">Open</span>
                                                                    <?php
                                                                    }
                                                                    if ($a == 2) {
                                                                    ?>
                                                                        <span class="badge bg-soft-warning">Solved</span>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <!-- Badge -->
                                                                    <a href="query_profile.php?qid=<?php echo $urow['QueryId']; ?>" type="button" class="btn btn-sm btn-info">View</a>
                                                                    <a href="qrystatus.php?qid=<?php echo $urow['QueryId']; ?>" type="button" class="btn btn-sm btn-danger">Close</a>
                                                                </td>
                                                            <tr id="demo<?php echo $j++; ?>" class="collapse">
                                                                <td colspan="6" class="hiddenRow">
                                                                    <div><?php echo $urow['QueryQuestion']; ?></div>
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
                                                    <li class="active"><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">1</a>
                                                    </li>
                                                    <li><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">2</a></li>
                                                    <li><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">3</a></li>
                                                    <li><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">4</a></li>
                                                    <li><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">5</a></li>
                                                    <li><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">6</a></li>
                                                    <li><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">7</a></li>
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
                </div>
            </div>
        </div>
    </div>
    <?php include("context.php"); ?>
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <!-- Vendor JS -->
    <script src="../assets/js/vendor.bundle.js"></script>
    <!-- Theme JS -->
    <script src="../assets/js/theme.bundle.js"></script>
    <!-- Delete Popup -->
</body>

</html>