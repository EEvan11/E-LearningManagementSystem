<?php
include '../includes/session.php';
include '../includes/dbconnect.php';

// Logic to handle calendar events creation, editing, and deletion will be added here...
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher - Class Calendar</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/teacher.css">
</head>
<body>
    <header>Class Calendar</header>
    
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
                <h2>Add a New Event</h2>
                <!-- Interface to add a new event to the calendar -->
                <form action="#" method="post">
                    <label for="event_name">Event Name:</label>
                    <input type="text" id="event_name" name="event_name">
                    <label for="event_date">Event Date:</label>
                    <input type="date" id="event_date" name="event_date">
                    <input type="submit" value="Add Event">
                </form>
                
                <h2>Your Class Events</h2>
                <!-- List of class events -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch class events from the calendar table
                        // For simplicity, let's assume all events are global and apply to all classes.
                        $sql = "SELECT * FROM calendar ORDER BY event_date DESC";
                        $result = $pdo->query($sql);
                        
                        if ($result->rowCount() > 0) {
                            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["event_name"] . "</td>";
                                echo "<td>" . $row["event_date"] . "</td>";
                                echo "<td><a href='#'>Edit</a> | <a href='#'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No events added yet.</td></tr>";
                        }
                        $pdo = null; // Close PDO connection
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
