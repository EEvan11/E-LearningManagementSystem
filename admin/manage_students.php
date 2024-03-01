<?php
include '../includes/session.php';
include '../includes/dbconnect.php';
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
                <!-- Filter for Grade and Section -->
                <div class="filters">
                    <label for="gradeFilter">Filter by Grade:</label>
                    <select id="gradeFilter" name="gradeFilter">
                        <option value="all">All</option>
                        <option value="1">Grade 1</option>
                        <option value="2">Grade 2</option>
                        <option value="3">Grade 3</option>
                        <!-- Add more grade options as needed -->
                    </select>

                    <label for="sectionFilter">Filter by Section:</label>
                    <select id="sectionFilter" name="sectionFilter">
                        <option value="all">All</option>
                        <option value="A">Section A</option>
                        <option value="B">Section B</option>
                        <option value="C">Section C</option>
                        <!-- Add more section options as needed -->
                    </select>

                    <button id="applyFilter">Apply Filter</button>
                </div>
                
                <!-- List of students from the database with Grade and Section headers -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Grade</th>
                            <th>Section</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch students from the database using PDO with Grade and Section
                        $stmt = $pdo->prepare("SELECT u.id, u.name, u.email, s.grade, s.section FROM users u
                            LEFT JOIN student_info s ON u.id = s.user_id
                            WHERE u.role='student'");
                        $stmt->execute();
                        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if ($students) {
                            foreach ($students as $row) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["grade"] . "</td>";
                                echo "<td>" . $row["section"] . "</td>";
                                echo "<td><a href='#'>Edit</a> | <a href='#'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No students found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <footer>Footer content here</footer>
    
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/admin.js"></script>
</body>
</html>