<?php
include("../includes/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

$question_id = $_GET['question_id'];
$message = "";

if(isset($_POST['addOption']))
{
    $option_text = mysqli_real_escape_string($conn, $_POST['option_text']);

    $query = "INSERT INTO options
              (question_id, option_text)
              VALUES
              ('$question_id','$option_text')";

    if(mysqli_query($conn,$query))
    {
        $message = "<div class='alert alert-success'>
                        Option Added Successfully!
                    </div>";
    }
    else
    {
        $message = "<div class='alert alert-danger'>
                        Failed to Add Option!
                    </div>";
    }
}
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Add Options</h3>
        </div>

        <div class="card-body">

            <h4>Question ID :
                <?php echo $question_id; ?>
            </h4>

            <hr>

            <?php
            if (!empty($message)) {
                echo $message;
            }
            ?>

            <form method="POST">

                <div class="mb-3">
                    <label>Option Text</label>

                    <input type="text" name="option_text" class="form-control" placeholder="Enter option" required>
                </div>

                <button type="submit" name="addOption" class="btn btn-success">
                    Add Option
                </button>

            </form>

        </div>

    </div>

</div>

<?php
include("../includes/footer.php");
?>