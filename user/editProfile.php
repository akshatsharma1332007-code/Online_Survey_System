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

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];

    $updateQuery = "UPDATE users
                    SET name='$name',
                        email='$email'
                    WHERE user_id='$user_id'";

    if(mysqli_query($conn, $updateQuery))
    {
        $_SESSION['name'] = $name;

        echo "<script>
                alert('Profile Updated Successfully');
                window.location='profile.php';
              </script>";
    }
}
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">
<h3>Edit Profile</h3>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input
type="text"
name="name"
class="form-control"
value="<?php echo $user['name']; ?>"
required>
</div>

<div class="mb-3">
<label>Email</label>
<input
type="email"
name="email"
class="form-control"
value="<?php echo $user['email']; ?>"
required>
</div>

<button
type="submit"
name="update"
class="btn btn-success">
Update Profile
</button>

<a href="profile.php" class="btn btn-secondary">
Cancel
</a>

</form>

</div>

</div>

</div>

<?php include("../includes/footer.php"); ?>