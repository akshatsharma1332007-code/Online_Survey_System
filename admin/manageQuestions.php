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

if (!isset($_GET['survey_id'])) {
    header("Location: viewSurvey.php");
    exit();
}

$survey_id = (int) $_GET['survey_id'];

$surveyQuery = "SELECT * FROM surveys WHERE survey_id='$survey_id'";
$surveyResult = mysqli_query($conn, $surveyQuery);
$survey = mysqli_fetch_assoc($surveyResult);

$questionQuery = "SELECT * FROM questions
                  WHERE survey_id='$survey_id'
                  ORDER BY question_id ASC";

$questionResult = mysqli_query($conn, $questionQuery);
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h2>Manage Questions</h2>
        </div>

        <div class="card-body">

            <?php if ($survey) { ?>

                <h4><?php echo htmlspecialchars($survey['title']); ?></h4>

            <?php } ?>

            <p>Survey ID: <?php echo $survey_id; ?></p>

            <hr>

            <a href="addQuestion.php?survey_id=<?php echo $survey_id; ?>"
               class="btn btn-primary mb-3">
                Add Question
            </a>

            <?php if (mysqli_num_rows($questionResult) > 0) { ?>

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($question = mysqli_fetch_assoc($questionResult)) { ?>

                            <tr>

                                <td>
                                    <?php echo $question['question_id']; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($question['question_text']); ?>
                                </td>

                                <td>
                                    <?php echo ucfirst($question['question_type']); ?>
                                </td>

                                <td>

                                    <?php if ($question['question_type'] != "text") { ?>

                                        <a href="addOption.php?question_id=<?php echo $question['question_id']; ?>"
                                           class="btn btn-success btn-sm">
                                            Manage Options
                                        </a>

                                    <?php } ?>

                                    <a href="deleteQuestion.php?id=<?php echo $question['question_id']; ?>&survey_id=<?php echo $survey_id; ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this question?');">
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } else { ?>

                <div class="alert alert-warning">
                    No questions have been added to this survey yet.
                </div>

            <?php } ?>

            <a href="viewSurvey.php" class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>