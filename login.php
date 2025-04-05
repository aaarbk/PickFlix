<?php
// login.php
require_once __DIR__ . '/includes/functions.php'; // Use functions to load data

// Ensure this script is accessed via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login_form.php');
    exit();
}

$username_input = trim($_POST['username'] ?? '');
$password_input = $_POST['password'] ?? ''; // Don't trim password

// Basic validation
if (empty($username_input) || empty($password_input)) {
    header('Location: login_form.php?error=Username and password are required.');
    exit();
}

// Flag to check if authentication is successful
$authenticated = false;
$currentUser = null;

// Load users from JSON
$users = getAllUsers();

// Iterate over the users array to find the user
foreach ($users as $user) {
    // Check if the username matches (case-insensitive for username)
    if (isset($user['username']) && strtolower($user['username']) === strtolower($username_input)) {
        // Verify password (plain text comparison as requested)
        if (isset($user['password']) && $user['password'] === $password_input) {
            $authenticated = true;
            $currentUser = $user;
            break;
        }
    }
}

if ($authenticated && $currentUser) {
    // Start a session
    session_start();

    // Regenerate session ID for security
    session_regenerate_id(true);

    // Authentication successful, set session variables
    $_SESSION['user_id'] = $currentUser['id']; // Use ID from JSON
    $_SESSION['username'] = $currentUser['username'];
    $_SESSION['first_name'] = $currentUser['firstName'] ?? ''; // Use null coalescing for optional fields
    $_SESSION['last_name'] = $currentUser['lastName'] ?? '';
    $_SESSION['email'] = $currentUser['email'] ?? '';
    $_SESSION['country'] = $currentUser['country'] ?? '';
    $_SESSION['preferred_movie'] = $currentUser['preferredMovieId'] ?? null; // Store ID
    $_SESSION['preferred_tvshow'] = $currentUser['preferredTVShowId'] ?? null; // Store ID

    // Set session timeout in seconds (30 minutes)
    $_SESSION['timeout'] = time() + (30 * 60);

    // Redirect to home page after successful login
    header('Location: index.php');
    exit();
} else {
    // If authentication fails, redirect back to login form with an error
    header('Location: login_form.php?error=Invalid username or password.');
    exit();
}
?>