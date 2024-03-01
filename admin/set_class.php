<?php
include '../includes/session.php';
include '../includes/dbconnect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $subject = $_POST['subject'];
    $teacher_id = $_POST['teacher_id'];

    $sql = "INSERT INTO classes (grade, section, subject, teacher_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$grade, $section, $subject, $teacher_id]);

    $message = "Class successfully set!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Class</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        Set Class
    </header>

    <div class="container">
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

        <main>
            <h2>Set Class</h2>
            <p><?php echo $message; ?></p>

            <form action="" method="post">
    <label for="grade">Grade:</label>
    <select id="grade" name="grade" required>
        <option value="1">Grade 1</option>
        <option value="2">Grade 2</option>
        <option value="3">Grade 3</option>
        <!-- Add more options for various grades as needed -->
    </select><br><br>

    <label for="section">Section:</label>
    <select id="section" name="section" required>
        <option value="A">Section A</option>
        <option value="B">Section B</option>
        <option value="C">Section C</option>
        <!-- Add more options for different sections as needed -->
    </select><br><br>

    <label for="teacher_id">Teacher:</label>
    <select id="teacher_id" name="teacher_id" required>
        <option value="1">Teacher 1</option>
        <option value="2">Teacher 2</option>
        <option value="3">Teacher 3</option>
        <!-- Add more options for different teachers as needed -->
    </select><br><br>

    <button type="submit">Set Class</button>
</form>
        </main>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your School Name</p>
    </footer>
</body>
</html>
