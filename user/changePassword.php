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

if(isset($_POST['change']))
{
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $query = "SELECT * FROM users WHERE user_id='$user_id'";
    $result = mysqli_query($conn,$query);
    $user = mysqli_fetch_assoc($result);

    if(password_verify($current,$user['password']))
    {
        if($new == $confirm)
        {
            $newPassword = password_hash($new,PASSWORD_DEFAULT);

            $update = "UPDATE users
                       SET password='$newPassword'
                       WHERE user_id='$user_id'";

            mysqli_query($conn,$update);

            echo "<script>
                    alert('Password Changed Successfully');
                    window.location='profile.php';
                  </script>";
        }
        else
        {
            echo "<script>alert('New Password and Confirm Password do not match');</script>";
        }
    }
    else
    {
        echo "<script>alert('Current Password is Incorrect');</script>";
    }
}
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-danger text-white">
<h3>Change Password</h3>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Current Password</label>
<input
type="password"
name="current_password"
class="form-control"
required>
</div>

<div class="mb-3">
<label>New Password</label>
<input
type="password"
name="new_password"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Confirm Password</label>
<input
type="password"
name="confirm_password"
class="form-control"
required>
</div>

<button
type="submit"
name="change"
class="btn btn-danger">
Change Password
</button>

<a href="profile.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</div>

</div>

<?php include("../includes/footer.php"); ?>