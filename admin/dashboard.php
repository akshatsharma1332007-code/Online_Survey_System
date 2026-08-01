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

include("../includes/header.php");
include("../includes/navbar.php");
include("../includes/db.php");

// Total Users
$userQuery = "SELECT COUNT(*) AS total_users FROM users";
$userResult = mysqli_query($conn, $userQuery);
$totalUsers = mysqli_fetch_assoc($userResult)['total_users'];

// Total Surveys
$surveyQuery = "SELECT COUNT(*) AS total_surveys FROM surveys";
$surveyResult = mysqli_query($conn, $surveyQuery);
$totalSurveys = mysqli_fetch_assoc($surveyResult)['total_surveys'];

// Total Questions
$questionQuery = "SELECT COUNT(*) AS total_questions FROM questions";
$questionResult = mysqli_query($conn, $questionQuery);
$totalQuestions = mysqli_fetch_assoc($questionResult)['total_questions'];

// Total Responses
$responseQuery = "SELECT COUNT(*) AS total_responses FROM responses";
$responseResult = mysqli_query($conn, $responseQuery);
$totalResponses = mysqli_fetch_assoc($responseResult)['total_responses'];


$recentSurveyQuery = "SELECT * FROM surveys ORDER BY created_at DESC LIMIT 5";
$recentSurveyResult = mysqli_query($conn, $recentSurveyQuery);

$latestResponseQuery = "
SELECT
responses.response_id,
responses.submitted_at,
users.name,
surveys.title
FROM responses
JOIN users
ON responses.user_id = users.user_id
JOIN surveys
ON responses.survey_id = surveys.survey_id
ORDER BY responses.submitted_at DESC
LIMIT 5
";

$latestResponseResult = mysqli_query($conn, $latestResponseQuery);
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h3>Admin Dashboard</h3>
        </div>

        <div class="card-body">

            <h4>Welcome Admin,
                <?php echo $_SESSION['name']; ?>
            </h4>

            <hr>

            <div class="row text-center">

                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            <h5>Total Users</h5>
                            <h2><?php echo $totalUsers; ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            <h5>Total Surveys</h5>
                            <h2><?php echo $totalSurveys; ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card bg-warning text-dark shadow">
                        <div class="card-body">
                            <h5>Total Questions</h5>
                            <h2><?php echo $totalQuestions; ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            <h5>Total Responses</h5>
                            <h2><?php echo $totalResponses; ?></h2>
                        </div>
                    </div>
                </div>

                <hr>

                <h4 class="mt-4">Latest Responses</h4>

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>Response ID</th>
                            <th>User</th>
                            <th>Survey</th>
                            <th>Submitted At</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        if (!$latestResponseResult) {
                            die(mysqli_error($conn));
                        }

                        while ($response = mysqli_fetch_assoc($latestResponseResult)) {
                            ?>

                            <tr>

                                <td><?php echo $response['response_id']; ?></td>

                                <td><?php echo $response['name']; ?></td>

                                <td><?php echo $response['title']; ?></td>

                                <td><?php echo $response['submitted_at']; ?></td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>
            </div>

            <hr>

            <a href="createSurvey.php" class="btn btn-success">
                Create Survey
            </a>

            <a href="viewSurvey.php" class="btn btn-primary">
                View Surveys
            </a>
            <a href="analytics.php" class="btn btn-info">
                Analytics
            </a>

            <a href="manageUsers.php" class="btn btn-warning">
                Manage Users
            </a>

            <a href="../authorization/logout.php" class="btn btn-danger">
                Logout
            </a>
            <hr>

            <h4 class="mt-4">Recent Surveys</h4>

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>

                <tbody>

                    <?php while ($recentSurvey = mysqli_fetch_assoc($recentSurveyResult)) { ?>

                        <tr>

                            <td><?php echo $recentSurvey['survey_id']; ?></td>

                            <td><?php echo $recentSurvey['title']; ?></td>

                            <td><?php echo $recentSurvey['status']; ?></td>

                            <td><?php echo $recentSurvey['created_at']; ?></td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>