<?php
include '../includes/session.php';
include '../includes/dbconnect.php';

$teacher_id = $_SESSION['user_id'];

// Fetch all assignments created by the teacher
$sql = "SELECT * FROM assignments WHERE teacher_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$teacher_id]);
$assignments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher - View Assignments</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/teacher.css">
</head>
<body>
    <header>View Your Assignments</header>
    
    <div class="container">
        <div class="dashboard">
            <div class="sidebar">
                <!-- ... (keep the sidebar as is) ... -->
            </div>
            
            <div class="main-content">
                <h2>Your Assignments</h2>

                <ul>
                    <?php foreach ($assignments as $assignment) : ?>
                        <li>
                            <strong>Question:</strong> <?php echo $assignment['question']; ?><br>
                            <strong>Number of Questions:</strong> <?php echo $assignment['num_questions']; ?><br>
                            <strong>Number of Choices:</strong> <?php echo $assignment['num_choices']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    
    <footer>Footer content here</footer>
    
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/teacher.js"></script>
</body>
</html>
