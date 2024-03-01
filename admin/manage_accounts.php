<?php
include '../includes/dbconnect.php';
include '../includes/session.php';

// Fetch all users along with grade and section names
$stmt = $pdo->prepare("
    SELECT 
        users.id, users.name, users.email, users.role, 
        grades.grade_name, sections.section_name 
    FROM users 
    LEFT JOIN students ON users.id = students.user_id 
    LEFT JOIN grades ON students.grade = grades.id 
    LEFT JOIN sections ON students.section = sections.id 
    ORDER BY users.role
");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Students</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>Admin - Manage Students</header>
    
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
                <h2>Manage Students</h2>
                <!-- Add this radio button section to your HTML -->
<div class="student-filter">
    <input type="text" id="search-bar" placeholder="Search by name">
    <label for="registered">Registered</label>
    <input type="radio" id="registered" name="user-type" value="registered">
    <label for="unregistered">Unregistered</label>
    <input type="radio" id="unregistered" name="user-type" value="unregistered">
    <label for="students">Students</label>
    <input type="radio" id="students" name="user-type" value="students">
    <label for="teachers">Teachers</label>
    <input type="radio" id="teachers" name="user-type" value="teachers">
    <label for="admins">Admins</label>
    <input type="radio" id="admins" name="user-type" value="admins">
</div>


                <div class="student-list">
                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">John Doe</span>
                            <span class="student-email">johndoe@email.com</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">View</a>
                        </div>
                    </div>

                    <div class="student-card">
                        <div class="student-info">
                            <span class="student-name">Rambutan</span>
                            <span class="student-email">rambi@gm.bom</span>
                        </div>
                        <div class="student-actions">
                            <a href="#">Edit</a>
                        </div>
                    </div>
                    <!-- Add more student cards as needed -->
                </div>
            </div>
        </div>
    </div>
    
    <footer>Footer content here</footer>
    
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/admin.js"></script>
</body>
</html>
