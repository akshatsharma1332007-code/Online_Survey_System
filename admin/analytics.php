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
$query = "
SELECT
surveys.title,
COUNT(responses.response_id) AS totalResponses
FROM surveys
LEFT JOIN responses
ON surveys.survey_id = responses.survey_id
GROUP BY surveys.survey_id
";

$result = mysqli_query($conn, $query);

$surveyTitles = [];
$responseCounts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $surveyTitles[] = $row['title'];
    $responseCounts[] = $row['totalResponses'];
}
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Survey Analytics</h3>
        </div>

        <div class="card-body">

            <canvas id="surveyChart" height="100"></canvas>

        </div>

    </div>

</div>


<?php
include("../includes/footer.php");
?>

<script>

const ctx = document.getElementById('surveyChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: <?php echo json_encode($surveyTitles); ?>,

        datasets: [{

            label: 'Responses',

            data: <?php echo json_encode($responseCounts); ?>,

            borderWidth: 1

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});

</script>