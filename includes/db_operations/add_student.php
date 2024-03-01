<?php
include '../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $grade = $_POST["grade"];
    $section = $_POST["section"];

    $sql = "INSERT INTO students (name, email, grade, section) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $grade, $section);

    if ($stmt->execute()) {
        echo "Student added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
