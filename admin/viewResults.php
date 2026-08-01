<?php
include("../includes/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$survey_id = $_GET['survey_id'];
$surveyQuery = "SELECT * FROM surveys WHERE survey_id='$survey_id'";
$surveyResult = mysqli_query($conn, $surveyQuery);
$survey = mysqli_fetch_assoc($surveyResult);

$responseQuery = "SELECT * FROM responses WHERE survey_id='$survey_id'";
$responseResult = mysqli_query($conn, $responseQuery);
$totalResponses = mysqli_num_rows($responseResult);
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">

            <h3>Survey Results</h3>

        </div>

        <div class="card-body">

            <h4>
                Survey Title :
                <?php echo $survey['title']; ?>
            </h4>

            <hr>

            <p>
                <strong>Description :</strong>
                <?php echo $survey['description']; ?>
            </p>

            <p>
                <strong>Total Responses :</strong>
                <?php echo $totalResponses; ?>
            </p>
            <a href="exportResults.php?survey_id=<?php echo $survey_id; ?>" class="btn btn-success mb-3">
                Export Results to CSV
            </a>

            <hr>

            <h4 class="mt-4">Submitted Responses</h4>

            <?php

            $responseQuery = "SELECT * FROM responses WHERE survey_id='$survey_id'";
            $responseResult = mysqli_query($conn, $responseQuery);

            while ($response = mysqli_fetch_assoc($responseResult)) {
                $response_id = $response['response_id'];

                echo "<div class='card mt-3'>";
                echo "<div class='card-header bg-secondary text-white'>";
                echo "<h5>Response ID : " . $response_id . "</h5>";
                echo "</div>";
                echo "<div class='card-body'>";

                $answerQuery = "
        SELECT
            questions.question_text,
            answers.answer
        FROM answers
        JOIN questions
        ON answers.question_id = questions.question_id
        WHERE answers.response_id='$response_id'
    ";

                $answerResult = mysqli_query($conn, $answerQuery);

                while ($answer = mysqli_fetch_assoc($answerResult)) {
                    ?>

                    <div class="mb-4">

                        <h5>
                            <?php echo $answer['question_text']; ?>
                        </h5>

                        <p class="alert alert-light">
                            <?php echo $answer['answer']; ?>
                        </p>

                    </div>

                    <?php
                }

                echo "</div>";
                echo "</div>";

            }
            ?>