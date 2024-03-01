<?php
include '../includes/session.php';
include '../includes/dbconnect.php';

// Logic to handle quiz answering and submission will be added here...

?>

<!DOCTYPE html>
<html>
<head>
    <title>Answer Assignments</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
    <header>Answer Assignments</header>
    
    <div class="container">
        <div class="dashboard">
            <div class="sidebar">
            <a href="index.php">Dashboard</a>
                <a href="view_classmates.php">View Classmates</a>
                <a href="answer_quiz.php">Answer Quiz</a>
                <a href="view_evaluations.php">View Evaluations</a>
                <a href="view_announcements.php">View Announcements</a> 
                <a href="../logout.php">Logout</a>
            </div>
            
            <div class="main-content">
                <h2>Assignments</h2>
                <!-- List of available quizzes for the student to answer -->
               <!-- List of available quizzes based on the student's grade and section -->
<table>
    <thead>
        <tr>
            <th>Quiz ID</th>
            <th>Question</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch available quizzes based on the student's grade and section
        $sql = "SELECT quizzes.id as quiz_id, quizzes.question
                FROM quizzes
                JOIN students ON quizzes.grade = students.grade AND quizzes.section = students.section
                WHERE students.id = $student_id";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["quiz_id"] . "</td>";
            echo "<td>" . $row["question"] . "</td>";
            echo "<td><a href='answer_specific_quiz.php?quiz_id=" . $row["quiz_id"] . "'>Answer</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
            </div>
        </div>
    </div>
    
    <footer>Footer content here</footer>
    
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/student.js"></script>
</body>
</html>
