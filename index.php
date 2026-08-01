<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Online Survey System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<?php
include("includes/header.php");
include("includes/navbar.php");
?>


<body>

<div class="conatiner mt-5">
    <div class="text-center">
        <h1>Welcome to online survey System</h1>
        <p class="lead">Create surveys, collect responses, and analyze results easily.</p>
        <a href="authorization/login.php" class="btn btn-primary btn-lg me-3">
            Login
        </a>
        <a href="authorization/register.php" class="btn btn-primary btn-lg me-3">
            Register
        </a>
    </div>
</div>

<?php
include("includes/footer.php");
?>

</body>
</html>