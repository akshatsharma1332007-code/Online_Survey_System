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

if (!isset($_GET['survey_id'])) {
    header("Location: viewSurvey.php");
    exit();
}

$survey_id = (int) $_GET['survey_id'];
$message = "";

if (isset($_POST['addQuestion'])) {

    $question_text = mysqli_real_escape_string($conn, $_POST['question_text']);
    $question_type = mysqli_real_escape_string($conn, $_POST['question_type']);

    $query = "INSERT INTO questions
              (survey_id, question_text, question_type)
              VALUES
              ('$survey_id','$question_text','$question_type')";

    if (mysqli_query($conn, $query)) {

        $question_id = mysqli_insert_id($conn);

        if ($question_type == "radio" || $question_type == "checkbox") {
            header("Location: addOption.php?question_id=$question_id");
            exit();
        } else {
            header("Location: manageQuestions.php?survey_id=$survey_id");
            exit();
        }

    } else {

        $message = "<div class='alert alert-danger'>
                        Failed to Add Question!
                    </div>";
    }
}

include("../includes/header.php");
include("../includes/navbar.php");
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Add Question</h3>
        </div>

        <div class="card-body">

            <?php
            if (!empty($message)) {
                echo $message;
            }
            ?>

            <form method="POST">

                <div class="mb-3">

                    <label>Question</label>

                    <textarea name="question_text"
                              class="form-control"
                              rows="3"
                              required></textarea>

                </div>

                <div class="mb-3">

                    <label>Question Type</label>

                    <select name="question_type"
                            class="form-control"
                            required>

                        <option value="text">
                            Text Answer
                        </option>

                        <option value="radio">
                            Multiple Choice (Single Answer)
                        </option>

                        <option value="checkbox">
                            Multiple Choice (Multiple Answers)
                        </option>

                    </select>

                </div>

                <button type="submit"
                        name="addQuestion"
                        class="btn btn-success">

                    Add Question

                </button>

                <a href="manageQuestions.php?survey_id=<?php echo $survey_id; ?>"
                   class="btn btn-secondary">

                    Back

                </a>

            </form>

        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>