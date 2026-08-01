<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">

    <div class="container-fluid">

        <a class="navbar-brand" href="/index.php">
            <img src="/images/images.jpg"
                 alt="Online Survey System Logo"
                 height="40"
                 width="40">
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-3">

                <li class="nav-item">
                    <a class="nav-link" href="/index.php">
                        Home
                    </a>
                </li>

                <?php if (!isset($_SESSION['user_id'])) { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/authorization/login.php">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/authorization/register.php">
                            Register
                        </a>
                    </li>

                <?php } elseif ($_SESSION['role'] == "admin") { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard.php">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/viewSurvey.php">
                            Surveys
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/analytics.php">
                            Analytics
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/manageUsers.php">
                            Manage Users
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="/authorization/logout.php">
                            Logout
                        </a>
                    </li>

                <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/user/dashboard.php">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/user/availableSurveys.php">
                            Available Surveys
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/user/myResponses.php">
                            Survey History
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/user/profile.php">
                            My Profile
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="/authorization/logout.php">
                            Logout
                        </a>
                    </li>

                <?php } ?>

            </ul>

        </div>

    </div>

</nav>