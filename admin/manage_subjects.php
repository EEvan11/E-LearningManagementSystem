<?php
include '../includes/session.php';
include '../includes/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Subjects</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>Admin - Manage Subjects</header>
    
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
                <h2>Manage Subjects</h2>
        

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

                    <input type="text" id="search-bar" placeholder="Search Subject">
                    <button id="applyFilter">Apply Filter</button>
                </div>

                <!-- List of subjects from the database with Grade and Section headers -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject Name</th>
                            <th>Grade</th>
                            <th>Section</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch subjects from the database using PDO with Grade and Section
                        $stmt = $pdo->prepare("SELECT s.id, s.subject_name, t.grade, t.section FROM subjects s
                            LEFT JOIN subject_info t ON s.id = t.subject_id");
                        $stmt->execute();
                        $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if ($subjects) {
                            foreach ($subjects as $row) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["subject_name"] . "</td>";
                                echo "<td>" . $row["grade"] . "</td>";
                                echo "<td>" . $row["section"] . "</td>";
                                echo "<td><a href='#'>Edit</a> | <a href='#'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No subjects found.</td></tr>";
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