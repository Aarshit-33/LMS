<html>

<head></head>

</html>

<body>
    <?php
    session_start();
    if ($_SESSION['role'] != "Texas") {
        header("Location: ../index.php");
    } else {
        include_once("../config.php");
        $_SESSION["userrole"] = "Faculty";
        $id = $_GET['qid'];
        $id = mysqli_real_escape_string($conn, $id);
        $qur = "UPDATE accountquerymaster SET Querystatus = '2' WHERE QueryId = '$id'";
        $res = mysqli_query($conn, $qur);
        if ($res) {
            echo "<script>alert('Successfully');</script>";
            header("Location: student_queries.php");
        } else {
            echo "<script>alert('Failed');</script>";
            header("Location: student_queries.php");
        }
    }
    ?>

</body>

</html>