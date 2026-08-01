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

if (!isset($_GET['id'])) {
    header("Location: manageUsers.php");
    exit();
}

$user_id = (int) $_GET['id'];

if ($user_id == $_SESSION['user_id']) {
    header("Location: manageUsers.php");
    exit();
}

mysqli_begin_transaction($conn);

try {

    $responseQuery = "
        SELECT response_id
        FROM responses
        WHERE user_id = '$user_id'
    ";

    $responseResult = mysqli_query($conn, $responseQuery);

    while ($response = mysqli_fetch_assoc($responseResult)) {

        $response_id = $response['response_id'];

        mysqli_query(
            $conn,
            "DELETE FROM answers
             WHERE response_id = '$response_id'"
        );
    }

    mysqli_query(
        $conn,
        "DELETE FROM responses
         WHERE user_id = '$user_id'"
    );

    mysqli_query(
        $conn,
        "DELETE FROM users
         WHERE user_id = '$user_id'"
    );

    mysqli_commit($conn);

    header("Location: manageUsers.php?deleted=1");
    exit();

} catch (Throwable $e) {

    mysqli_rollback($conn);

    header("Location: manageUsers.php?error=1");
    exit();
}
?>