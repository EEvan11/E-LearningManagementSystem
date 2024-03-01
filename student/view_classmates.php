<?php
include '../includes/session.php';
include '../includes/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Classmates</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
    <header>Your Classmates</header>
    
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
                <h2>Classmates</h2>
                <!-- List of classmates in the same classes as the logged-in student -->
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Classes in Common</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $student_id = $_SESSION['user_id'];  // Assuming the session contains the logged-in user's ID
                        
                        // Fetch classmates who share the same classes as the logged-in student
                        $sql = "SELECT DISTINCT users.name, users.email
                                FROM students
                                JOIN classes ON students.class_id = classes.id
                                JOIN users ON students.user_id = users.id
                                WHERE classes.id IN (
                                    SELECT class_id FROM students WHERE user_id = :student_id
                                ) AND students.user_id != :student_id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['student_id' => $student_id]);
                        
                        if ($stmt->rowCount() > 0) {
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>Class details here...</td>";  // Additional logic needed to fetch exact classes
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No classmates found.</td></tr>";
                        }
                        $pdo = null; // Close PDO connection
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
