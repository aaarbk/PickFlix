<?php
// register.php
require_once __DIR__ . '/includes/functions.php'; // Use functions

// Ensure this script is accessed via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register_form.php');
    exit();
}

// Retrieve and trim form data
$firstName = trim($_POST['firstName'] ?? '');
$lastName = trim($_POST['lastName'] ?? '');
$email = trim($_POST['email'] ?? '');
$dateOfBirth = trim($_POST['dateOfBirth'] ?? '');
$country = trim($_POST['country'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? ''; // Don't trim password
$confirmPassword = $_POST['confirmPassword'] ?? '';

// --- Server-Side Validation ---
$errors = [];

if (empty($firstName)) $errors[] = "First name is required.";
if (empty($lastName)) $errors[] = "Last name is required.";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
if (empty($dateOfBirth)) $errors[] = "Date of birth is required."; // Basic check, more specific date validation could be added
if (empty($country)) $errors[] = "Country is required.";
if (empty($username)) $errors[] = "Username is required.";
if (empty($password)) $errors[] = "Password is required.";
if ($password !== $confirmPassword) $errors[] = "Passwords do not match.";

// Check username/email uniqueness
if (empty($errors)) { // Only check if basic validation passed
    $users = getAllUsers();
    foreach ($users as $user) {
        if (isset($user['username']) && strtolower($user['username']) === strtolower($username)) {
            $errors[] = "Username already taken. Please choose another.";
            break; // Stop checking once found
        }
         if (isset($user['email']) && strtolower($user['email']) === strtolower($email)) {
            $errors[] = "Email address already registered.";
            break; // Stop checking once found
        }
    }
}
// --- End Validation ---


if (!empty($errors)) {
    // If errors, redirect back to form with error messages and preserved data
    $errorString = urlencode(implode("<br>", $errors));
    $queryString = http_build_query([
        'error' => $errorString,
        'fname' => $firstName,
        'lname' => $lastName,
        'email' => $email,
        'dob' => $dateOfBirth,
        'country' => $country,
        'uname' => $username
    ]);
    header("Location: register_form.php?" . $queryString);
    exit();
} else {
    // If validation passes, prepare user data
    $newUserData = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'dateOfBirth' => $dateOfBirth,
        'country' => $country,
        'username' => $username,
        'password' => $password, // Store plain text password
        'preferredMovieId' => null, // Default null
        'preferredTVShowId' => null  // Default null
    ];

    // Add user to JSON file
    if (addUser($newUserData)) {
        // Success - Redirect to login page with success message
        header('Location: login_form.php?success=Registration successful! Please log in.');
        exit();
    } else {
        // Handle potential file save error (rare with proper permissions)
        $errorString = urlencode("Registration failed due to a server error. Please try again.");
         $queryString = http_build_query([
            'error' => $errorString,
            'fname' => $firstName,
            'lname' => $lastName,
            'email' => $email,
            'dob' => $dateOfBirth,
            'country' => $country,
            'uname' => $username
        ]);
        header("Location: register_form.php?" . $queryString);
        exit();
    }
}
?>