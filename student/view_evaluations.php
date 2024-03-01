<?php
include '../includes/session.php';
include '../includes/dbconnect.php';

// Logic to fetch evaluations for the student will be added here...

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Evaluations</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
    <header>Your Evaluations</header>
    
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
                <h2>Quiz Evaluations</h2>
                <!-- List of quiz evaluations for the student -->
                <table>
                    <thead>
                        <tr>
                            <th>Quiz ID</th>
                            <th>Question</th>
                            <th>Your Answer</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $student_id = $_SESSION['user_id'];  // Assuming the session contains the logged-in user's ID
                        
                        // Fetch evaluations for the quizzes answered by the student
                        $sql = "SELECT quizzes.id as quiz_id, quizzes.question, student_quizzes.answer, student_quizzes.score 
                                FROM student_quizzes 
                                JOIN quizzes ON student_quizzes.quiz_id = quizzes.id 
                                WHERE student_quizzes.student_id = :student_id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['student_id' => $student_id]);
                        
                        if ($stmt->rowCount() > 0) {
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row["quiz_id"] . "</td>";
                                echo "<td>" . $row["question"] . "</td>";
                                echo "<td>" . $row["answer"] . "</td>";
                                echo "<td>" . $row["score"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No quizzes answered yet.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <h2>Assignment Evaluations</h2>
                <!-- List of assignment evaluations for the student -->
                <table>
                    <thead>
                        <tr>
                            <th>Assignment ID</th>
                            <th>Description</th>
                            <th>Submitted File</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch evaluations for the assignments submitted by the student
                        $sql = "SELECT assignments.id as assignment_id, assignments.assignment_description, student_assignments.submitted_file, student_assignments.score 
                                FROM student_assignments 
                                JOIN assignments ON student_assignments.assignment_id = assignments.id 
                                WHERE student_assignments.student_id = :student_id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['student_id' => $student_id]);
                        
                        if ($stmt->rowCount() > 0) {
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row["assignment_id"] . "</td>";
                                echo "<td>" . $row["assignment_description"] . "</td>";
                                echo "<td>" . $row["submitted_file"] . "</td>";
                                echo "<td>" . $row["score"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No assignments submitted yet.</td></tr>";
                        }
                        $pdo = null;  // Close PDO connection
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
