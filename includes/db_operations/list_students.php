<?php
include '../dbconnect.php';

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

$students = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
$conn->close();

// The array $students now contains details of all students.
?>
