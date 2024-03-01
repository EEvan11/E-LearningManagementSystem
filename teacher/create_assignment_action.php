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

    // Insert the assignment into the database
    try {
        $sql = "INSERT INTO assignments (question, num_questions, num_choices, teacher_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$question, $num_questions, $num_choices, $teacher_id]);

        // Redirect to a suitable page with success message (e.g., view_assignments.php)
        $_SESSION['success'] = "Assignment created successfully!";
        header("Location: view_assignments.php");
        exit;
        
    } catch (PDOException $e) {
        // Handle error
        $_SESSION['error'] = "Error creating assignment: " . $e->getMessage();
        header("Location: create_quiz.php");  // Redirect back to the quiz/assignment creation page
        exit;
    }
} else {
    // Redirect back if not a POST request
    header("Location: create_quiz.php");
    exit;
}

?>
