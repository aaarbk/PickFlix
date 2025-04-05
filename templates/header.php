<?php
session_start(); // Start session on every page using the header
require_once __DIR__ . '/../includes/functions.php'; // Adjust path if needed

// Check for session timeout on each page load
if (isset($_SESSION['timeout']) && time() > $_SESSION['timeout']) {
    session_unset();
    session_destroy();
    // Optional: Redirect to login with a message
    header('Location: login_form.php?message=Session timed out. Please log in again.');
    exit();
}
// Update timeout on activity
if (isset($_SESSION['user_id'])) {
    $_SESSION['timeout'] = time() + (30 * 60); // Reset timeout to 30 mins
}

$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? htmlspecialchars($_SESSION['username']) : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PickFlix - <?php echo $pageTitle ?? 'Movie & TV Recommendations'; // Allow pages to set their own title ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navigation Bar (Using Bootstrap 5 classes) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">PickFlix</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'rankings.php') ? 'active' : ''; ?>" href="rankings.php">Rankings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'service.php') ? 'active' : ''; ?>" href="service.php">Service Info</a>
                    </li>
                     <?php if ($is_logged_in): ?>
                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="fas fa-user"></i> <?php echo $username; ?>
                             </a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                                 <li><a class="dropdown-item" href="profile.php#my-reviews">My Reviews</a></li>
                                 <li><hr class="dropdown-divider"></li>
                                 <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                             </ul>
                         </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'login_form.php') ? 'active' : ''; ?>" href="login_form.php">Login</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'register_form.php') ? 'active' : ''; ?>" href="register_form.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Start of main content container (closed in footer.php) -->
    <div class="main-content container mt-4">