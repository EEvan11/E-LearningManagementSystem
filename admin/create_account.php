<?php
include '../includes/dbconnect.php';
include '../includes/session.php';

// Fetching grades
$stmt = $pdo->prepare("SELECT id, grade_name FROM grades");
$stmt->execute();
$grades = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetching sections for the first grade as an example
$stmt = $pdo->prepare("SELECT id, section_name FROM sections");
$stmt->execute();
$sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);  // Encrypting password using MD5 for simplicity
    $role = $_POST['role'];
    $grade = $_POST['grade'];
    $section = $_POST['section'];

    // Insert into users table
    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $password, $role]);

    $last_id = $pdo->lastInsertId();

    if ($role == 'student') {
        $sql = "INSERT INTO students (user_id, grade, section) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$last_id, $grade, $section]);
    }

    header("Location: manage_accounts.php");  // Redirect to manage accounts page
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>Create New Account</header>
    
    <div class="container">
        <form action="create_account.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>

            <label for="grade">Grade:</label>
            <select id="grade" name="grade">
                <?php
                foreach ($grades as $grade) {
                    echo "<option value='{$grade['id']}'>{$grade['grade_name']}</option>";
                }
                ?>
            </select>

            <label for="section">Section:</label>
            <select id="section" name="section">
                <?php
                foreach ($sections as $section) {
                    echo "<option value='{$section['id']}'>{$section['section_name']}</option>";
                }
                ?>
            </select>

            <input type="submit" value="Create Account">
        </form>
    </div>
    
    <footer>Footer content here</footer>
    
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/admin.js"></script>
    <script>
        document.getElementById('grade').addEventListener('change', function() {
    var grade_id = this.value;

    // Make AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_sections.php?grade_id=' + grade_id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var sections = JSON.parse(xhr.responseText);
            var sectionDropdown = document.getElementById('section');

            // Clear existing options
            sectionDropdown.innerHTML = '';

            // Populate dropdown with new sections
            sections.forEach(function(section) {
                var option = document.createElement('option');
                option.value = section.id;
                option.textContent = section.section_name;
                sectionDropdown.appendChild(option);
            });
        }
    };
    xhr.send();
});

    </script>
</body>
</html>
