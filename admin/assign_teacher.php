<?php
include '../includes/session.php';
include '../includes/dbconnect.php';


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher_id = $_POST['teacher_id'];
    $class_id = $_POST['class_id'];

    $sql = "UPDATE classes SET teacher_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $teacher_id, $class_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: manage_classes.php");  // Redirect to manage classes page
    exit;
}

// Fetch teachers
$sql_teachers = "SELECT id, name FROM users WHERE role = 'teacher'";
$result_teachers = $conn->query($sql_teachers);

// Fetch classes
$sql_classes = "SELECT id, class_name FROM classes";
$result_classes = $conn->query($sql_classes);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Teachers to Classes</title>
</head>
<body>
    <form action="assign_teacher.php" method="post">
        <label for="teacher">Select Teacher:</label>
        <select name="teacher_id" required>
            <?php while ($row = $result_teachers->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>

        <label for="class">Select Class:</label>
        <select name="class_id" required>
            <?php while ($row = $result_classes->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['class_name']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>

        <input type="submit" value="Assign Teacher">
    </form>
</body>
</html>
