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
SELECT user_id, name, email, role
FROM users
ORDER BY user_id DESC
";

$result = mysqli_query($conn, $query);
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h3>Manage Users</h3>
        </div>

        <div class="card-body">
            
            <?php if (isset($_GET['deleted'])) { ?>

                <div class="alert alert-success">
                    User deleted successfully.
                </div>

            <?php } ?>

            <?php if (isset($_GET['error'])) { ?>

                <div class="alert alert-danger">
                    Unable to delete user.
                </div>

            <?php } ?>

            <?php if (mysqli_num_rows($result) > 0) { ?>

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($user = mysqli_fetch_assoc($result)) { ?>

                            <tr>

                                <td>
                                    <?php echo $user['user_id']; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($user['name']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($user['email']); ?>
                                </td>

                                <td>
                                    <?php echo ucfirst($user['role']); ?>
                                </td>

                                <td>

                                    <?php if ($user['user_id'] != $_SESSION['user_id']) { ?>

                                        <a href="deleteUser.php?id=<?php echo $user['user_id']; ?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this user?');">
                                            Delete
                                        </a>

                                    <?php } else { ?>

                                        <span class="badge bg-success">
                                            Current Admin
                                        </span>

                                    <?php } ?>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } else { ?>

                <div class="alert alert-warning">
                    No users found.
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