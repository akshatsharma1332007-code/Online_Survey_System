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

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Available Surveys</h3>
        </div>

        <div class="card-body">

            <?php

            $query = "SELECT * FROM surveys
          WHERE status = 'published'
          ORDER BY created_at DESC";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                ?>

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        while ($survey = mysqli_fetch_assoc($result)) {

                            $survey_id = $survey['survey_id'];

                            $checkQuery = "
                                SELECT response_id
                                FROM responses
                                WHERE survey_id='$survey_id'
                                AND user_id='$user_id'
                            ";

                            $checkResult = mysqli_query($conn, $checkQuery);

                            ?>

                            <tr>

                                <td>
                                    <?php echo $survey['survey_id']; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($survey['title']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($survey['description']); ?>
                                </td>

                                <td>

                                    <?php if (mysqli_num_rows($checkResult) > 0) { ?>

                                        <button class="btn btn-secondary" disabled>
                                            Already Submitted
                                        </button>

                                    <?php } else { ?>

                                        <a href="takeSurvey.php?survey_id=<?php echo $survey_id; ?>" class="btn btn-primary">
                                            Take Survey
                                        </a>

                                    <?php } ?>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } else { ?>

                <div class="alert alert-warning">
                    No surveys available.
                </div>

            <?php } ?>

        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>