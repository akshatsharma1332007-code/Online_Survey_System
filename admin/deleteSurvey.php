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

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $query = "DELETE FROM surveys WHERE survey_id='$id'";

    if(mysqli_query($conn, $query))
    {
        header("Location: viewSurvey.php");
        exit();
    }
    else
    {
        echo "Failed to delete survey!";
    }
}
?>