<?php
include '../includes/session.php';
include '../includes/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Classes</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>Admin - Manage Classes</header>
    
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
                <h2>Manage Classes</h2>
                <!-- Interface to add new classes -->
                <form action="#" method="post" id="filterForm">
                    <label for="grade">Grade:</label>
                    <select id="grade" name="grade">
                        <option value="1">Grade 1</option>
                        <option value="2">Grade 2</option>
                        <!-- Add more options for other grades -->
                    </select>
                    <label for="section">Section:</label>
                    <select id="section" name="section">
                        <option value="A">Section A</option>
                        <option value="B">Section B</option>
                        <!-- Add more options for other sections -->
                    </select>
                    <button type="button" onclick="filterClasses()">Filter</button>
                </form>
                <!-- List of classes from the database with Grade and Section -->
                <table>
                    <thead>
                        <tr>
                            <th>Grade</th>
                            <th>Section</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // This PHP code fetches classes from the database with Grade and Section
                        // Modify the SQL query as needed
                        $sql = "SELECT teachers.grade, teachers.section 
                                FROM classes 
                                JOIN teachers ON classes.teacher_id = teachers.id";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["grade"] . "</td>";
                                echo "<td>" . $row["section"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No classes found.</td></tr>";
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
    <script src="../assets/js/admin.js"></script>
    
    <script>
        function filterClasses() {
            // You can implement JavaScript logic here to filter the classes
            // based on the selected grade and section
        }
    </script>
</body>
</html>
