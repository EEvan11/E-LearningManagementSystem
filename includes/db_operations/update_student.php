<?php
include '../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $grade = $_POST["grade"];
    $section = $_POST["section"];

    $sql = "UPDATE students SET name=?, email=?, grade=?, section=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $grade, $section, $student_id);

    if ($stmt->execute()) {
        echo "Student details updated!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
