<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../authorization/login.php");
    exit();
}

include("../includes/db.php");

if (!isset($_GET['survey_id'])) {
    die("Survey ID not found.");
}

$survey_id = (int) $_GET['survey_id'];

$query = "
    SELECT 
        responses.response_id,
        users.name,
        users.email,
        questions.question_text,
        answers.answer,
        responses.submitted_at
    FROM responses
    LEFT JOIN users
        ON responses.user_id = users.user_id
    JOIN answers
        ON responses.response_id = answers.response_id
    JOIN questions
        ON answers.question_id = questions.question_id
    WHERE responses.survey_id = '$survey_id'
    ORDER BY responses.response_id
";

$result = mysqli_query($conn, $query);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="survey_results.csv"');

$output = fopen("php://output", "w");

fputcsv($output, [
    'Response ID',
    'User Name',
    'Email',
    'Question',
    'Answer',
    'Submitted At'
]);

while ($row = mysqli_fetch_assoc($result)) {

    fputcsv($output, [
        $row['response_id'],
        $row['name'],
        $row['email'],
        $row['question_text'],
        $row['answer'],
        $row['submitted_at']
    ]);
}

fclose($output);
exit();
?>

