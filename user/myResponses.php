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

$query = "
SELECT 
    responses.response_id,
    responses.submitted_at,
    surveys.title,
    surveys.description
FROM responses
JOIN surveys
ON responses.survey_id = surveys.survey_id
WHERE responses.user_id = '$user_id'
ORDER BY responses.submitted_at DESC
";

$result = mysqli_query($conn, $query);
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>My Survey History</h3>
        </div>

        <div class="card-body">

            <?php if (mysqli_num_rows($result) > 0) { ?>

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>
                            <th>Response ID</th>
                            <th>Survey</th>
                            <th>Description</th>
                            <th>Submitted At</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                            <tr>

                                <td>
                                    <?php echo $row['response_id']; ?>
                                </td>

                                <td>
                                    <?php echo $row['title']; ?>
                                </td>

                                <td>
                                    <?php echo $row['description']; ?>
                                </td>

                                <td>
                                    <?php echo $row['submitted_at']; ?>
                                </td>

                                <td>
                                    <a href="viewMyResponse.php?response_id=<?php echo $row['response_id']; ?>"
                                       class="btn btn-info btn-sm">
                                        View Answers
                                    </a>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } else { ?>

                <div class="alert alert-warning">
                    You have not submitted any surveys yet.
                </div>

            <?php } ?>

            <a href="dashboard.php" class="btn btn-secondary">
                Back to Dashboard
            </a>

        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>