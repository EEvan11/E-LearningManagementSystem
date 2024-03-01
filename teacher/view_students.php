<?php
include '../includes/session.php';
include '../includes/dbconnect.php';


?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher - View Students</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/teacher.css">
</head>
<body>
    <header>View Your Students</header>
    
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
    <h2>Your Students</h2>
    <!-- List of students from the database -->
    <table>
        <!-- ... (table headers) ... -->
        <tbody>
            <?php
            // Fetch students enrolled in classes taught by the teacher
            $teacher_id = $_SESSION['user_id'];  // Assuming the session contains the logged-in user's ID
            $stmt = $pdo->prepare("SELECT students.id, users.name, users.email, classes.class_name 
                                   FROM students 
                                   JOIN users ON students.user_id = users.id 
                                   JOIN classes ON students.class_id = classes.id 
                                   WHERE classes.teacher_id = ?");
            $stmt->execute([$teacher_id]);

            if ($stmt->rowCount() > 0) {
                while($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["class_name"] . "</td>";
                    echo "<td><a href='#'>Contact</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No students found in your classes.</td></tr>";
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