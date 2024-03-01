<?php
// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Get user role from session
function getUserRole() {
    return $_SESSION['role'] ?? '';
}

// Escape input to prevent SQL injection
function escapeInput($input) {
    global $pdo;
    return htmlspecialchars(strip_tags($input));
}

// Verify password (placeholder, should use password_hash and password_verify in a real application)
function verifyPassword($password, $hashedPassword) {
    return $password == $hashedPassword; // Placeholder, DO NOT use in production
}

function createStudent($name, $grade, $section) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO students (name, grade, section) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $grade, $section);
    $stmt->execute();
    $stmt->close();
}

function getQuizzesForStudent($student_id) {
    global $conn;
    $sql = "SELECT quizzes.id, quizzes.question FROM quizzes JOIN students ON quizzes.grade = students.grade AND quizzes.section = students.section WHERE students.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $quizzes = [];
    while($row = $result->fetch_assoc()) {
        $quizzes[] = $row;
    }
    $stmt->close();
    return $quizzes;
}

?>