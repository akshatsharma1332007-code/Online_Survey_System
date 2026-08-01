<?php
include("../includes/db.php");
include("../includes/header.php");
include("../includes/navbar.php");


if(isset($_POST['register']))
{
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0)
    {
        $message = "<div class='alert alert-danger'>Email already exists!</div>";
    }
    else
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users(name, email, password, role)
                  VALUES('$fullname','$email','$hashedPassword','respondent')";

        if(mysqli_query($conn, $query))
        {
            $message = "<div class='alert alert-success'>
                        Registration Successful!
                        </div>";
        }
        else
        {
            $message = "<div class='alert alert-danger'>
                        Registration Failed!
                        </div>";
        }
    }
}

?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card header bg-primary text-white">
                    <h3 class="text-center">User Registration</h3>
                </div>
                <div class="card body">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                    <form action="" method="post">
                        <div class="md-3">
                            <label>Full name</label>
                            <input type="text" name="fullname" id="fullname" placeholder="Enter your name" class="form-control"
                                required>
                        </div>
                        <div class="md-3">
                            <label>Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>
                        </div>
                        <div class="md-3">
                            <label>Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control"
                                required>
                        </div>
                        <button type="submit" name="register" class="btn btn-success w-100">
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("../includes/footer.php");
?>