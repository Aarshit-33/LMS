<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/favicon/favicon.ico" type="image/x-icon" />
    <title>LMS by Titanslab</title>
    <style>
        body {
            background-color: #f9fbfd;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['role'] != "Lagos") {
        header("Location: ../index.php");
    } else {
        include_once("../config.php");
        $_SESSION["userrole"] = "Faculty";
        $assid = $_GET['assid'];
        $assid = mysqli_real_escape_string($conn, $assid);
        try {
            $qur = "DELETE FROM assignmentmaster WHERE AssignmentId = '$assid'";
            $res = mysqli_query($conn, $qur);
            if ($res) {
                echo "<script>alert('Assignment Deleted Successfully');</script>";
                echo "<script>window.open('assignment_list.php','_self');</script>";
            } else {
                echo "<script>alert('This Assignment Has Submissions, So Can not Delete .. !');</script>";
                echo "<script>window.open('assignment_list.php','_self');</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('This Assignment Has Submissions, So Can not Delete .. !');</script>";
            echo "<script>window.open('assignment_list.php','_self');</script>";
        }
    }
    ?>
</body>

</html>