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


$totalSurveyQuery = "SELECT COUNT(*) AS total FROM surveys";

$totalSurveyResult = mysqli_query($conn, $totalSurveyQuery);

$totalSurveys = mysqli_fetch_assoc($totalSurveyResult)['total'];




$completedQuery = "
    SELECT COUNT(DISTINCT survey_id) AS completed
    FROM responses
    WHERE user_id='$user_id'
";

$completedResult = mysqli_query($conn, $completedQuery);

$completedSurveys = mysqli_fetch_assoc($completedResult)['completed'];




$pendingSurveys = $totalSurveys - $completedSurveys;

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3>User Dashboard</h3>
        </div>

        <div class="card-body">

            <h4>
                Welcome,
                <?php echo $_SESSION['name']; ?>
            </h4>

            <hr>




            <div class="row text-center mb-4">




                <div class="col-md-4 mb-3">

                    <div class="card bg-primary text-white shadow">

                        <div class="card-body">

                            <h5>Available Surveys</h5>

                            <h2>
                                <?php echo $totalSurveys; ?>
                            </h2>

                        </div>

                    </div>

                </div>




                <div class="col-md-4 mb-3">

                    <div class="card bg-success text-white shadow">

                        <div class="card-body">

                            <h5>Surveys Completed</h5>

                            <h2>
                                <?php echo $completedSurveys; ?>
                            </h2>

                        </div>

                    </div>

                </div>




                <div class="col-md-4 mb-3">

                    <div class="card bg-warning text-dark shadow">

                        <div class="card-body">

                            <h5>Pending Surveys</h5>

                            <h2>
                                <?php echo $pendingSurveys; ?>
                            </h2>

                        </div>

                    </div>

                </div>

            </div>


            <hr>




            <a href="availableSurveys.php" class="btn btn-primary">
                View Available Surveys
            </a>

            <a href="myResponses.php" class="btn btn-success">
                My Survey History
            </a>

            <a href="profile.php" class="btn btn-info">
                My Profile
            </a>

            <a href="../authorization/logout.php" class="btn btn-danger">
                Logout
            </a>


        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>