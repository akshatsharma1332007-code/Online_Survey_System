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
include("../includes/header.php");
include("../includes/navbar.php");

$id = $_GET['id'];

$query = "SELECT * FROM surveys WHERE survey_id='$id'";
$result = mysqli_query($conn, $query);
$survey = mysqli_fetch_assoc($result);

$message = "";

if(isset($_POST['updateSurvey']))
{
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $update = "UPDATE surveys
               SET title='$title',
                   description='$description'
               WHERE survey_id='$id'";

    if(mysqli_query($conn,$update))
    {
        $message = "<div class='alert alert-success'>
                        Survey Updated Successfully!
                    </div>";

        $result = mysqli_query($conn,"SELECT * FROM surveys WHERE survey_id='$id'");
        $survey = mysqli_fetch_assoc($result);
    }
}
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">
<h3>Edit Survey</h3>
</div>

<div class="card-body">

<?php
if(!empty($message))
{
    echo $message;
}
?>

<form method="POST">

<div class="mb-3">

<label>Survey Title</label>

<input
type="text"
name="title"
class="form-control"
value="<?php echo $survey['title'];?>"
required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"
rows="5"
required><?php echo $survey['description'];?></textarea>

</div>

<button
type="submit"
name="updateSurvey"
class="btn btn-warning">

Update Survey

</button>

<a href="viewSurvey.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</div>

</div>

<?php
include("../includes/footer.php");
?>