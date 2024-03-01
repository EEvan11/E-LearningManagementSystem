<?php
include '../includes/session.php';
include '../includes/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/teacher.css">
</head>
<body>
    <header>Teacher Dashboard</header>
    
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
                <h2>Welcome to Your Dashboard</h2>
                
                <div class="overview">
                    <h3>Overview:</h3>
                    <?php
                    // Fetch quick overview details for the teacher
                    $teacher_id = $_SESSION['user_id'];  // Assuming the session contains the logged-in user's ID
                    $stmt1 = $pdo->prepare("SELECT COUNT(*) as count FROM classes WHERE teacher_id = ?");
                    $stmt1->execute([$teacher_id]);
                    $classes_count = $stmt1->fetch()["count"];

                    
                    $stmt2 = $pdo->prepare("SELECT COUNT(DISTINCT user_id) as count FROM students JOIN classes ON students.class_id = classes.id WHERE classes.teacher_id = ?");

                    $stmt2->execute([$teacher_id]);
                    $students_count = $stmt2->fetch()["count"];
                    ?>
                    
                    <div class="overview-item">
                        <h4>Total Classes:</h4>
                        <p><?= $classes_count ?></p>
                    </div>
                    <div class="overview-item">
                        <h4>Total Students:</h4>
                        <p><?= $students_count ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer>Footer content here</footer>
    
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/teacher.js"></script>
</body>
</html>
