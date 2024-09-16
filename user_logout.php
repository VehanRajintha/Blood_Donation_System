<?php
// Start the session
session_start();

// Debugging: Check if session is set
if (isset($_SESSION['un'])) {
    echo "Session is set. Destroying session.";
} else {
    echo "Session is not set.";
}

// Destroy the session
session_destroy();

// Debugging: Check if session is destroyed
if (!isset($_SESSION['un'])) {
    echo "Session destroyed.";
} else {
    echo "Session not destroyed.";
}

// Redirect to the login page
header("Location: donor-login.php");
exit();
?>