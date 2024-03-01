<?php
include '../includes/session.php';
include '../includes/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher - Manage Classes</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/teacher.css">
</head>
<body>
    <header>Manage Your Classes</header>
    
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
    <h2>Your Classes</h2>
    <?php
    // Fetch classes assigned to the teacher from the database
    $teacher_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT classes.id, classes.class_name, subjects.subject_name 
                           FROM classes 
                           JOIN subjects ON classes.subject_id = subjects.id 
                           WHERE classes.teacher_id = ?");
    $stmt->execute([$teacher_id]);
    
    if ($stmt->rowCount() > 0) {
    ?>
        <!-- List of classes from the database -->
        <table>
            <!-- ... (table headers) ... -->
            <tbody>
                <?php
                while($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["class_name"] . "</td>";
                    echo "<td>" . $row["subject_name"] . "</td>";
                    echo "<td><a href='#'>View Details</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "<p>You are not assigned to any classes.</p>";
    }
    ?>
</div>
        </div>
    </div>
    
    <footer>Footer content here</footer>
    
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/teacher.js"></script>
</body>
</html>