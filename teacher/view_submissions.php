<?php
include '../includes/session.php';
include '../includes/dbconnect.php';

$teacher_id = $_SESSION['user_id'];
 
/*
// Fetching quizzes
$sql_quizzes = "SELECT * FROM student_quizzes WHERE teacher_id = ?";
$stmt_quizzes = $pdo->prepare($sql_quizzes);
$stmt_quizzes->execute([$teacher_id]);
$quizzes = $stmt_quizzes->fetchAll();

// Fetching assignments
$sql_assignments = "SELECT * FROM student_assignments WHERE teacher_id = ?";
$stmt_assignments = $pdo->prepare($sql_assignments);
$stmt_assignments->execute([$teacher_id]);
$assignments = $stmt_assignments->fetchAll();
*/


?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher - View Submissions</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/teacher.css">
</head>
<body>
    <header>View Submissions</header>
    
    <div class="container">
        <div class="dashboard">
            <div class="sidebar">
            <a href="index.php">Dashboard</a>
                <a href="manage_classes.php">My Classes</a>
                <a href="view_students.php">View Students</a>
                <a href="create_assignments.php">Create assignments</a>
                <a href="view_submissions.php">Submissions</a>
                <a href="grade_assignments.php">Grade Assignments</a>
                <a href="announcements.php">Announcements</a>
                <a href="class_calendar.php">Class Calendar</a>
                <a href="../logout.php">Logout</a>
            </div>
            
            <div class="main-content">
                <h2>View Submissions</h2>

                <h3>Quizzes</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Quiz ID</th>
                            <th>Student Name</th>
                            <th>Submission Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($quizzes as $quiz) {
                            echo "<tr>";
                            echo "<td>" . $quiz["quiz_id"] . "</td>";
                            echo "<td>" . "Student Name Placeholder" . "</td>"; // Replace with student name
                            echo "<td>" . $quiz["submission_date"] . "</td>";
                            echo "<td><a href='#'>View</a></td>"; // Add a link to view the submission
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <h3>Assignments</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Assignment ID</th>
                            <th>Student Name</th>
                            <th>Submission Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($assignments as $assignment) {
                            echo "<tr>";
                            echo "<td>" . $assignment["assignment_id"] . "</td>";
                            echo "<td>" . "Student Name Placeholder" . "</td>"; // Replace with student name
                            echo "<td>" . $assignment["submission_date"] . "</td>";
                            echo "<td><a href='#'>View</a></td>"; // Add a link to view the submission
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
    <script src="../assets/js/teacher.js"></script>
</body>
</html>