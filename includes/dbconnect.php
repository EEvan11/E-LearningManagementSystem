<?php
// Database connection settings
$host = 'localhost'; // Change to your database host
$dbname = 'ElearningDB'; // Change to your database name
$user = 'root'; // Change to your database user
$pass = ''; // Change to your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>