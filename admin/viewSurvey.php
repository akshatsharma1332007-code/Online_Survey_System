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

$limit = 5;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$start = ($page - 1) * $limit;

$search = isset($_GET['search'])
    ? mysqli_real_escape_string($conn, $_GET['search'])
    : "";

$status = isset($_GET['status'])
    ? mysqli_real_escape_string($conn, $_GET['status'])
    : "";

$where = "WHERE 1=1";

if ($search != "") {
    $where .= " AND title LIKE '%$search%'";
}

if ($status != "") {
    $where .= " AND status='$status'";
}

$query = "SELECT * FROM surveys
          $where
          ORDER BY created_at DESC
          LIMIT $start, $limit";

$result = mysqli_query($conn, $query);

$countQuery = "SELECT COUNT(*) AS total
               FROM surveys
               $where";

$countResult = mysqli_query($conn, $countQuery);

$totalRows = mysqli_fetch_assoc($countResult)['total'];

$totalPages = ceil($totalRows / $limit);

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>All Surveys</h3>
        </div>

        <div class="card-body">

            <?php if (isset($_GET['status_updated'])) { ?>

                <div class="alert alert-success">
                    Survey status updated successfully.
                </div>

            <?php } ?>

            <form method="GET" class="mb-3">

                <div class="input-group">

                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search survey by title..."
                           value="<?php echo htmlspecialchars($search); ?>">

                    <select name="status" class="form-select">

                        <option value="">All Status</option>

                        <option value="draft"
                            <?php if ($status == "draft") echo "selected"; ?>>
                            Draft
                        </option>

                        <option value="published"
                            <?php if ($status == "published") echo "selected"; ?>>
                            Published
                        </option>

                    </select>

                    <button class="btn btn-primary">
                        Search
                    </button>

                </div>

            </form>

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if (mysqli_num_rows($result) > 0) { ?>

                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                            <tr>

                                <td>
                                    <?php echo $row['survey_id']; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['title']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['description']); ?>
                                </td>

                                <td>

                                    <?php if ($row['status'] == "published") { ?>

                                        <span class="badge bg-success">
                                            Published
                                        </span>

                                    <?php } else { ?>

                                        <span class="badge bg-secondary">
                                            Draft
                                        </span>

                                    <?php } ?>

                                </td>

                                <td>
                                    <?php echo $row['created_at']; ?>
                                </td>

                                <td>

                                    <a href="manageQuestions.php?survey_id=<?php echo $row['survey_id']; ?>"
                                       class="btn btn-success btn-sm">
                                        Questions
                                    </a>

                                    <a href="viewResults.php?survey_id=<?php echo $row['survey_id']; ?>"
                                       class="btn btn-info btn-sm">
                                        View Results
                                    </a>

                                    <a href="editSurvey.php?id=<?php echo $row['survey_id']; ?>"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <?php if ($row['status'] == "draft") { ?>

                                        <a href="changeSurveyStatus.php?id=<?php echo $row['survey_id']; ?>&status=published"
                                           class="btn btn-primary btn-sm">
                                            Publish
                                        </a>

                                    <?php } else { ?>

                                        <a href="changeSurveyStatus.php?id=<?php echo $row['survey_id']; ?>&status=draft"
                                           class="btn btn-secondary btn-sm">
                                            Move to Draft
                                        </a>

                                    <?php } ?>

                                    <a href="deleteSurvey.php?id=<?php echo $row['survey_id']; ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this survey?');">
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    <?php } else { ?>

                        <tr>

                            <td colspan="6" class="text-center text-danger">
                                No surveys found.
                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

            <?php if ($totalPages > 1) { ?>

                <nav>

                    <ul class="pagination">

                        <?php if ($page > 1) { ?>

                            <li class="page-item">

                                <a class="page-link"
                                   href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&status=<?php echo urlencode($status); ?>">
                                    Previous
                                </a>

                            </li>

                        <?php } ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>

                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">

                                <a class="page-link"
                                   href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&status=<?php echo urlencode($status); ?>">

                                    <?php echo $i; ?>

                                </a>

                            </li>

                        <?php } ?>

                        <?php if ($page < $totalPages) { ?>

                            <li class="page-item">

                                <a class="page-link"
                                   href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&status=<?php echo urlencode($status); ?>">
                                    Next
                                </a>

                            </li>

                        <?php } ?>

                    </ul>

                </nav>

            <?php } ?>

            <a href="dashboard.php" class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>