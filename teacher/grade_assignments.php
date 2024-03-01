<?php
include '../includes/session.php';
include '../includes/dbconnect.php';

// Logic to handle assignment grading will be added here...
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher - Grade Assignments</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/teacher.css">
</head>
<body>
    <header>Grade Submitted Assignments</header>
    
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
                <h2>Submitted Assignments</h2>
                <!-- List of submitted assignments from the database -->
                <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Assignment File</th>
            <th>Grade</th>
            <th>Feedback</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch assignments based on the teacher's assigned grade and section
        $sql = "SELECT assignments.id, students.name, assignments.file_path FROM assignments JOIN students ON assignments.student_id = students.id WHERE students.grade IN (SELECT grade FROM teachers WHERE id = $teacher_id) AND students.section IN (SELECT section FROM teachers WHERE id = $teacher_id)";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td><a href='" . $row["file_path"] . "'>Download</a></td>";
            echo "<td><input type='text' name='grade'></td>";
            echo "<td><input type='text' name='feedback'></td>";
            echo "<td><input type='submit' value='Submit Grade and Feedback'></td>";
            echo "</tr>";
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
