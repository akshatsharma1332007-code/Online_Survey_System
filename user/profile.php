<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../authorization/login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>My Profile</h3>
        </div>

        <div class="card-body">

            <p><strong>Name :</strong> <?php echo $user['name']; ?></p>

            <p><strong>Email :</strong> <?php echo $user['email']; ?></p>

            <p><strong>Role :</strong> <?php echo ucfirst($user['role']); ?></p>

            <p><strong>Joined :</strong> <?php echo $user['created_at']; ?></p>

            <a href="editProfile.php" class="btn btn-warning">
                Edit Profile
            </a>
            <a href="changePassword.php" class="btn btn-danger">
                Change Password
            </a>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>