<?php
include '../includes/session.php';
include '../includes/dbconnect.php';

// Logic to handle announcement creation, editing, and deletion will be added here...

?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher - Announcements</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/teacher.css">
</head>
<body>
    <header>Manage Announcements</header>
    
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
                <h2>Create a New Announcement</h2>
                <!-- Interface to create a new announcement -->
                <form action="#" method="post">
                    <label for="class">Select Class:</label>
                    <select id="class" name="class_id">
                        <!-- Fetch and display list of classes taught by the teacher -->
                        <?php
                        $teacher_id = $_SESSION['user_id'];  // Assuming the session contains the logged-in user's ID
                        $sql = "SELECT id, class_name FROM classes WHERE teacher_id = $teacher_id";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["id"] . "'>" . $row["class_name"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for="announcement_text">Announcement:</label>
                    <textarea id="announcement_text" name="announcement_text"></textarea>
                    <input type="submit" value="Post Announcement">
                </form>
                
                <h2>Your Previous Announcements</h2>
                <!-- List of previous announcements -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Announcement</th>
                            <th>Date Posted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch previous announcements made by the teacher
                        $sql = "SELECT id, announcement_text, date_posted 
                                FROM announcements 
                                WHERE teacher_id = $teacher_id 
                                ORDER BY date_posted DESC";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["announcement_text"] . "</td>";
                                echo "<td>" . $row["date_posted"] . "</td>";
                                echo "<td><a href='#'>Edit</a> | <a href='#'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No announcements made yet.</td></tr>";
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
    <script src="../assets/js/teacher.js"></script>
</body>
</html>