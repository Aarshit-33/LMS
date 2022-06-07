<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../head.php"); ?>

</head>

<body>
    <!-- NAVIGATION -->
    <?php
    $nav_role = "Dashboard";
    include_once("../nav.php"); ?>
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- HEADER -->
        <div class="header">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-end">
                        <div class="col">
                            <h5 class="header-pretitle mb-5">
                                <a class="btn btn-sm btn-outline-info" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
                            </h5>
                            <h6 class="header-pretitle">
                                <?php echo $_SESSION['userrole']; ?>
                            </h6>
                            <h1 class="header-title">
                                Dashboard
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARDS -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <img class="card-img-top" src="../assets/favicon/Change.jpg" alt="Card image cap">
                            <h3 class="mt-3 card-title">Change the main logo</h3>
                            <!-- add text or remove it -->
                            <p class="card-text">To change the main logo of the university click the button below.</p>
                            <a href="change_logo.php" class="btn btn-sm btn-primary">
                                Change
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <img class="card-img-top" src="../assets/favicon/manager.jpg" alt="Card image cap">
                            <h3 class="mt-3 card-title">Manage institute administrators</h3>
                            <!-- add text or remove it -->
                            <p class="card-text">Various functionalities that can be used to manage admins.</p>
                            <a href="add_institute.php" class="btn btn-sm btn-primary">
                                Add
                            </a>&nbsp;
                            <a href="edit_institute.php" class="btn btn-sm btn-warning">
                                Edit
                            </a>&nbsp;
                            <a href="institute_list.php" class="btn btn-sm btn-info">
                                List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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