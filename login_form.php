<?php
$pageTitle = "Login"; // Set page title
include 'templates/header.php'; // Use the header template

// Check for messages passed via GET parameters
$message = $_GET['message'] ?? '';
$error = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card bg-dark text-light border-secondary">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4 text-danger">Login to PickFlix</h2>

                    <?php if ($error): ?>
                        <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($success); ?></div>
                    <?php endif; ?>
                     <?php if ($message): ?>
                        <div class="alert alert-info" role="alert"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>


                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control bg-secondary text-light border-dark" id="username" name="username" placeholder="Enter username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control bg-secondary text-light border-dark" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-danger btn-block w-100">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0">Don't have an account? <a href="register_form.php" class="text-danger">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; // Use the footer template ?>