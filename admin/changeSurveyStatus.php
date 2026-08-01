<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../authorization/login.php");
    exit();
}

if ($_SESSION['role'] != "admin") {
    header("Location: ../user/dashboard.php");
    exit();
}

include("../includes/db.php");

if (!isset($_GET['id']) || !isset($_GET['status'])) {
    header("Location: viewSurvey.php");
    exit();
}

$survey_id = (int) $_GET['id'];

$status = $_GET['status'];

if ($status != "draft" && $status != "published") {
    header("Location: viewSurvey.php");
    exit();
}

$stmt = mysqli_prepare(
    $conn,
    "UPDATE surveys SET status = ? WHERE survey_id = ?"
);

mysqli_stmt_bind_param($stmt, "si", $status, $survey_id);

mysqli_stmt_execute($stmt);

header("Location: viewSurvey.php?status_updated=1");
exit();

?>