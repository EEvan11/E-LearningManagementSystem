<?php
include '../includes/session.php';
include '../includes/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>Admin Dashboard</header>
    
    <div class="container">
        <div class="dashboard">
            <div class="sidebar">
                <a href="index.php">Dashboard</a>
                <a href="manage_students.php">Manage Students</a>
                <a href="manage_teachers.php">Manage Teachers</a>
                <a href="manage_subjects.php">Manage Subjects</a>
                <a href="manage_classes.php">Manage Classes</a>
                <a href="manage_accounts.php">Accounts</a>
                <a href="create_account.php">Create Account</a>
                <a href="set_class.php">Set Classes</a>
                <a href="view_logs.php">View Logs</a>
                <a href="calendar.php">Calendar</a>
                <a href="../logout.php">Logout</a>
            </div>
            
            <div class="main-content">
                <h2>Welcome to the Admin Dashboard</h2>
                <div class="statistics">
                    <?php
                    // Fetch quick statistics from the database using PDO
                    $students_count = $pdo->query("SELECT COUNT(*) as count FROM students")->fetch()["count"];
                    $teachers_count = $pdo->query("SELECT COUNT(*) as count FROM teachers")->fetch()["count"];
                    $classes_count = $pdo->query("SELECT COUNT(*) as count FROM classes")->fetch()["count"];
                    $subjects_count = $pdo->query("SELECT COUNT(*) as count FROM subjects")->fetch()["count"];
                    ?>
                    
                    <div class="stat-item">
                        <h3>Total Students</h3>
                        <p><?= $students_count ?></p>
                    </div>
                    <div class="stat-item">
                        <h3>Total Teachers</h3>
                        <p><?= $teachers_count ?></p>
                    </div>
                    <div class="stat-item">
                        <h3>Total Classes</h3>
                        <p><?= $classes_count ?></p>
                    </div>
                    <div class="stat-item">
                        <h3>Total Subjects</h3>
                        <p><?= $subjects_count ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer>Footer content here</footer>
    
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/admin.js"></script>
</body>
</html>