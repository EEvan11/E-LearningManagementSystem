<?php
include '../includes/session.php';
include '../includes/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
    <header>Welcome to Your Dashboard</header>
    
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
                <h2>Your Classes</h2>
                <!-- List of subjects based on the student's grade and section -->
                <table>
                    <thead>
                        <tr>
                            <th>Subject ID</th>
                            <th>Subject Name</th>
                            <th>Teacher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch subjects based on the student's grade and section
                        $student_id = $_SESSION['user_id'];
                        $sql = "SELECT subjects.id as subject_id, subjects.subject_name, teachers.name as teacher_name
                        FROM subjects
                        JOIN teachers ON subjects.teacher_id = teachers.id
                        JOIN students ON subjects.grade = students.grade AND subjects.section = students.section
                        WHERE students.id = :student_id";
                
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
                        $stmt->execute();

                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row["subject_id"] . "</td>";
                            echo "<td>" . $row["subject_name"] . "</td>";
                            echo "<td>" . $row["teacher_name"] . "</td>";
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
