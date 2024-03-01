<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include session management and database connection
include 'includes/session.php';
include 'includes/dbconnect.php';
include 'includes/functions.php';

$error = '';

// Check if user is already logged in
if (isLoggedIn()) {
    $userRole = getUserRole();
    if ($userRole == 'admin') {
        header("Location: admin/index.php");
        exit();
    } elseif ($userRole == 'teacher') {
        header("Location: teacher/index.php");
        exit();
    } elseif ($userRole == 'student') {
        header("Location: student/index.php");
        exit();
    }
}

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = escapeInput($_POST['username']);
    $password = $_POST['password'];

    // Validate credentials against the database
    $stmt = $pdo->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && verifyPassword($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        
        // Redirect to respective dashboard
        if ($user['role'] == 'admin') {
            header("Location: admin/index.php");
            exit();
        } elseif ($user['role'] == 'teacher') {
            header("Location: teacher/index.php");
            exit();
        } elseif ($user['role'] == 'student') {
            header("Location: student/index.php");
            exit();
        }
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Management System</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <header>
        <img src="assets/images/logo.png" alt="E-Learning Logo">
        <nav>
            <!-- Navigation links can be added here -->
        </nav>
    </header>
    
    <main>
        <h1>Welcome to the E-Learning Management System</h1>
        <p>This is the main landing page for the system. From here, users can access their respective dashboards, view announcements, and more.</p>
        
        <!-- Display errors if any -->
        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        
        <!-- Example login form -->
        <section>
            <h2>Login</h2>
            <form action="index.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <input type="submit" value="Login">
            </form>
        </section>
        
        <!-- Any other content can be added here -->
    </main>
    
    <footer>
        <p>&copy; 2023 E-Learning Management System</p>
    </footer>
</body>
</html>
