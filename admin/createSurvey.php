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

$message = "";

if(isset($_POST['createSurvey']))
{
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $createdBy = $_SESSION['user_id'];

    $query = "INSERT INTO surveys(title, description, created_by)
              VALUES('$title','$description','$createdBy')";

    if(mysqli_query($conn,$query))
    {
        $message = "<div class='alert alert-success'>
                        Survey Created Successfully!
                    </div>";
    }
    else
    {
        $message = "<div class='alert alert-danger'>
                        Failed to Create Survey!
                    </div>";
    }
}
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    <h3>Create New Survey</h3>
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
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea
                                name="description"
                                rows="5"
                                class="form-control"
                                required></textarea>
                        </div>

                        <button
                            type="submit"
                            name="createSurvey"
                            class="btn btn-success">
                            Create Survey
                        </button>

                        <a href="dashboard.php"
                           class="btn btn-secondary">
                           Back
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>