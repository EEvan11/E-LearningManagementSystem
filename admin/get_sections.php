<?php
include '../includes/dbconnect.php';

$grade_id = $_GET['grade_id'];

$stmt = $pdo->prepare("SELECT id, section_name FROM sections WHERE grade_id = ?");
$stmt->execute([$grade_id]);
$sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($sections);
?>
