<?php
include '../includes/session.php';
include '../includes/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Teachers</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>Admin - Manage Teachers</header>
    
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
                <h2>Manage Teachers</h2>
                <!-- Filter for Handled Grade and Handled Section -->
                <div class="filters">
                    <label for="handledGradeFilter">Filter by Handled Grade:</label>
                    <select id="handledGradeFilter" name="handledGradeFilter">
                        <option value="all">All</option>
                        <option value="1">Grade 1</option>
                        <option value="2">Grade 2</option>
                        <option value="3">Grade 3</option>
                        <!-- Add more grade options as needed -->
                    </select>

                    <label for="handledSectionFilter">Filter by Handled Section:</label>
                    <select id="handledSectionFilter" name="handledSectionFilter">
                        <option value="all">All</option>
                        <option value="A">Section A</option>
                        <option value="B">Section B</option>
                        <option value="C">Section C</option>
                        <!-- Add more section options as needed -->
                    </select>

                    <button id="applyFilter">Apply Filter</button>
                </div>
                
                <!-- List of teachers from the database with Handled Grade and Handled Section headers -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Handled Grade</th>
                            <th>Handled Section</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch teachers from the database using PDO with Handled Grade and Handled Section
                        $stmt = $pdo->prepare("SELECT u.id, u.name, u.email, t.handled_grade, t.handled_section FROM users u
                            LEFT JOIN teacher_info t ON u.id = t.user_id
                            WHERE u.role='teacher'");
                        $stmt->execute();
                        $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if ($teachers) {
                            foreach ($teachers as $row) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["handled_grade"] . "</td>";
                                echo "<td>" . $row["handled_section"] . "</td>";
                                echo "<td><a href='#'>Edit</a> | <a href='#'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No teachers found.</td></tr>";
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