<?php
include '../includes/session.php';
include '../includes/dbconnect.php';

$teacher_id = $_SESSION['user_id'];

// Fetching the list of subjects handled by the teacher
$sql = "SELECT subjects.subject_name
        FROM subjects
        JOIN classes ON subjects.id = classes.subject_id
        WHERE classes.teacher_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$teacher_id]);
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher - Create Assignment</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/teacher.css">
</head>
<body>
    <header>Create a New Assignment</header>
    
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
                <h2>Create Assignment</h2>

                <!-- Display the list of handled subjects -->
                <h3>Subjects Handled:</h3>
                <ul>
                    <?php foreach ($subjects as $subject) : ?>
                        <li><?php echo $subject['subject_name']; ?></li>
                    <?php endforeach; ?>
                </ul>

                <!-- Selection for the type of assignment -->
                <label for="assignment_type">Type of Assignment:</label>
                <select id="assignment_type" name="assignment_type" onchange="updateFormAction();">
                    <option value="quiz">Quiz</option>
                    <option value="assignment">Assignment</option>
                </select>

                <!-- Interface to create a new assignment -->
                <form action="create_quiz_action.php" method="post" id="create_assignment_form">
                    <label for="question">Question:</label>
                    <input type="text" id="question" name="question" required>
                    <label for="num_questions">Number of Questions:</label>
                    <input type="number" id="num_questions" name="num_questions" required>
                    <label for="num_choices">Number of Choices:</label>
                    <input type="number" id="num_choices" name="num_choices" required>
                    <input type="submit" value="Create Assignment">
                </form>
            </div>
        </div>
    </div>
    
    <footer>Footer content here</footer>
    
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/teacher.js"></script>
    <script>
        function updateFormAction() {
            var assignmentType = document.getElementById("assignment_type").value;
            var form = document.getElementById("create_assignment_form");
            
            if (assignmentType == "quiz") {
                form.action = "create_quiz_action.php";
            } else {
                form.action = "create_assignment_action.php";
            }
        }
    </script>
</body>
</html>
