<?php
include("../includes/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$message = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);


        if (password_verify($password, $user['password'])) {
            session_start();

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == "admin") {
                header("Location: ../admin/dashboard.php");
                exit();
            } else {
                header("Location: ../user/dashboard.php");
                exit();
            }
        } else {
            $message = "<div class='alert alert-danger'>
                        Incorrect Password!
                        </div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>
                    Email not found!
                    </div>";
    }
}
?>
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h3 class="text-center">User Login</h3>
                </div>

                <div class="card-body"></div>
                <?php
                if (!empty($message)) {
                    echo $message;
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label> Email </label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label> Password </label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password"
                            required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">
                        Login
                    </button>
                    <p class="text-center mt-3">
                        Don't have an account?
                        <a href="register.php">Register Here</a>
                    </p>
                </form>

            </div>
        </div>
    </div>
</div>
<?php
include("../includes/footer.php");
?>