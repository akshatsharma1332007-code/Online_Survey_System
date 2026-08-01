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

if (!isset($_GET['response_id'])) {
    header("Location: myResponses.php");
    exit();
}

$response_id = (int) $_GET['response_id'];

$responseQuery = "
SELECT
    responses.response_id,
    responses.submitted_at,
    surveys.title,
    surveys.description
FROM responses
JOIN surveys
ON responses.survey_id = surveys.survey_id
WHERE responses.response_id = '$response_id'
AND responses.user_id = '$user_id'
";

$responseResult = mysqli_query($conn, $responseQuery);

if (mysqli_num_rows($responseResult) == 0) {
    header("Location: myResponses.php");
    exit();
}

$response = mysqli_fetch_assoc($responseResult);

$answerQuery = "
SELECT
    questions.question_text,
    answers.answer
FROM answers
JOIN questions
ON answers.question_id = questions.question_id
WHERE answers.response_id = '$response_id'
ORDER BY questions.question_id ASC
";

$answerResult = mysqli_query($conn, $answerQuery);
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3><?php echo htmlspecialchars($response['title']); ?></h3>
        </div>

        <div class="card-body">

            <h5>Survey Description</h5>

            <p>
                <?php echo htmlspecialchars($response['description']); ?>
            </p>

            <p>
                <strong>Submitted At:</strong>
                <?php echo $response['submitted_at']; ?>
            </p>

            <hr>

            <h4 class="mb-4">Your Answers</h4>

            <?php if (mysqli_num_rows($answerResult) > 0) { ?>

                <?php while ($answer = mysqli_fetch_assoc($answerResult)) { ?>

                    <div class="card mb-3">

                        <div class="card-body">

                            <h5>
                                <?php echo htmlspecialchars($answer['question_text']); ?>
                            </h5>

                            <p class="mb-0">
                                <strong>Your Answer:</strong>
                                <?php echo htmlspecialchars($answer['answer']); ?>
                            </p>

                        </div>

                    </div>

                <?php } ?>

            <?php } else { ?>

                <div class="alert alert-warning">
                    No answers found for this response.
                </div>

            <?php } ?>

            <a href="myResponses.php" class="btn btn-secondary">
                Back to Survey History
            </a>

        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>