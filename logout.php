<?php
// Start session
session_start();

// Destroy session to log the user out
session_destroy();

// Redirect to the main landing page
header("Location: index.php");
exit();
?>