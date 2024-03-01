<?php

include '../includes/session.php';
include '../includes/dbconnect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve post data
    $question = $_POST['question'];
    $num_questions = $_POST['num_questions'];
    $num_choices = $_POST['num_choices'];
    $teacher_id = $_SESSION['user_id'];

    // Insert the quiz into the database
    try {
        $sql = "INSERT INTO quizzes (question, num_questions, num_choices, teacher_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$question, $num_questions, $num_choices, $teacher_id]);

        // Redirect to the view quizzes page with success message
        $_SESSION['success'] = "Quiz created successfully!";
        header("Location: view_quizzes.php");
        exit;
        
    } catch (PDOException $e) {
        // Handle error
        $_SESSION['error'] = "Error creating quiz: " . $e->getMessage();
        header("Location: create_quiz.php");
        exit;
    }
} else {
    // Redirect back if not a POST request
    header("Location: create_quiz.php");
    exit;
}

?>
