<?php
include '../includes/session.php';
include '../includes/dbconnect.php';

// Logic to fetch announcements relevant to the student will be added here...

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Announcements</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
    <header>Class Announcements</header>
    
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
                <h2>Announcements</h2>
                <!-- List of announcements relevant to the student's classes -->
                <table>
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th>Announcement</th>
                            <th>Date Posted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $student_id = $_SESSION['user_id'];  // Assuming the session contains the logged-in user's ID
                        
                        // Fetch announcements relevant to the student's classes
                        $sql = "SELECT users.name as teacher_name, announcements.announcement_text, announcements.date_posted 
                                FROM announcements 
                                JOIN teachers ON announcements.teacher_id = teachers.id 
                                JOIN users ON teachers.user_id = users.id 
                                WHERE teachers.id IN (
                                    SELECT DISTINCT teacher_id FROM classes WHERE id IN (
                                        SELECT class_id FROM students WHERE user_id = $student_id
                                    )
                                ) ORDER BY announcements.date_posted DESC";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["teacher_name"] . "</td>";
                                echo "<td>" . $row["announcement_text"] . "</td>";
                                echo "<td>" . $row["date_posted"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No announcements available.</td></tr>";
                        }
                        $conn->close();
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