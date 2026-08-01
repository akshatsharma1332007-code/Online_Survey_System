<?php

session_start();

// User must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../authorization/login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$user_id = $_SESSION['user_id'];

$survey_id = isset($_GET['survey_id']) ? (int) $_GET['survey_id'] : 0;
$surveyCheck = mysqli_query(
    $conn,
    "SELECT survey_id FROM surveys
     WHERE survey_id='$survey_id'
     AND status='published'"
);

if (mysqli_num_rows($surveyCheck) == 0) {
    header("Location: availableSurveys.php");
    exit();
}

$message = "";

// When survey is submitted
if (isset($_POST['submitSurvey'])) {

    // Check if user has already submitted this survey
    $checkResponse = mysqli_query(
        $conn,
        "SELECT * FROM responses
         WHERE survey_id='$survey_id'
         AND user_id='$user_id'"
    );

    if (mysqli_num_rows($checkResponse) > 0) {

        $message = "
        <div class='alert alert-warning'>
            You have already submitted this survey.
        </div>";

    } else {

        // Create response
        $insertResponse = "
            INSERT INTO responses (survey_id, user_id)
            VALUES ('$survey_id', '$user_id')
        ";

        if (mysqli_query($conn, $insertResponse)) {

            $response_id = mysqli_insert_id($conn);

            // Save answers
            foreach ($_POST as $key => $value) {

                if (strpos($key, "answer_") === 0) {

                    $question_id = str_replace("answer_", "", $key);

                    $value = mysqli_real_escape_string($conn, $value);

                    $insertAnswer = "
                        INSERT INTO answers
                        (response_id, question_id, answer)
                        VALUES
                        ('$response_id', '$question_id', '$value')
                    ";

                    mysqli_query($conn, $insertAnswer);
                }
            }

            $message = "
            <div class='alert alert-success'>
                Survey submitted successfully!
            </div>";

        } else {

            $message = "
            <div class='alert alert-danger'>
                Error submitting survey.
            </div>";
        }
    }
}

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3>Take Survey</h3>
        </div>

        <div class="card-body">

            <?php echo $message; ?>

            <form method="POST">

                <?php

                $query = "
                    SELECT * FROM questions
                    WHERE survey_id='$survey_id'
                ";

                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {

                    while ($question = mysqli_fetch_assoc($result)) {

                        $question_id = $question['question_id'];

                        ?>

                        <div class="mb-4">

                            <h5>
                                <?php echo $question['question_text']; ?>
                            </h5>

                            <?php

                            // RADIO QUESTION
                            if ($question['question_type'] == "radio") {

                                $optionQuery = "
                                    SELECT * FROM options
                                    WHERE question_id='$question_id'
                                ";

                                $optionResult = mysqli_query($conn, $optionQuery);

                                while ($option = mysqli_fetch_assoc($optionResult)) {

                                    ?>

                                    <div class="form-check">

                                        <input class="form-check-input" type="radio" name="answer_<?php echo $question_id; ?>"
                                            value="<?php echo $option['option_text']; ?>" required>

                                        <label class="form-check-label">

                                            <?php echo $option['option_text']; ?>

                                        </label>

                                    </div>

                                    <?php
                                }

                            }

                            // TEXT QUESTION
                            elseif ($question['question_type'] == "text") {

                                ?>

                                <textarea class="form-control" name="answer_<?php echo $question_id; ?>" rows="3"
                                    required></textarea>

                                <?php
                            }

                            ?>

                        </div>

                        <?php
                    }

                    ?>

                    <div class="text-center mt-4">

                        <button type="submit" name="submitSurvey" class="btn btn-success btn-lg">
                            Submit Survey
                        </button>

                    </div>

                    <?php

                } else {

                    echo "
                    <div class='alert alert-warning'>
                        No questions found.
                    </div>";
                }

                ?>

            </form>

        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>