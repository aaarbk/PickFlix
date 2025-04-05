<?php
$pageTitle = "Register"; // Set page title
include 'templates/header.php';

// Check for error messages from registration attempt
$error = $_GET['error'] ?? '';

// Preserve input values if registration failed (optional, more advanced)
$prev_firstname = $_GET['fname'] ?? '';
$prev_lastname = $_GET['lname'] ?? '';
$prev_email = $_GET['email'] ?? '';
$prev_country = $_GET['country'] ?? '';
$prev_dob = $_GET['dob'] ?? '';
$prev_username = $_GET['uname'] ?? '';

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card bg-dark text-light border-secondary">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4 text-danger">Register for PickFlix</h2>

                    <?php if ($error): ?>
                        <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars(urldecode($error)); ?></div>
                    <?php endif; ?>

                    <form action="register.php" method="POST" id="registerForm">
                         <div class="row">
                             <div class="col-md-6 mb-3">
                                 <label for="firstName" class="form-label">First Name</label>
                                 <input type="text" class="form-control bg-secondary text-light border-dark" id="firstName" name="firstName" placeholder="John" value="<?php echo htmlspecialchars($prev_firstname); ?>" required>
                             </div>
                             <div class="col-md-6 mb-3">
                                 <label for="lastName" class="form-label">Last Name</label>
                                 <input type="text" class="form-control bg-secondary text-light border-dark" id="lastName" name="lastName" placeholder="Doe" value="<?php echo htmlspecialchars($prev_lastname); ?>" required>
                             </div>
                        </div>
                         <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control bg-secondary text-light border-dark" id="email" name="email" placeholder="name@example.com" value="<?php echo htmlspecialchars($prev_email); ?>" required>
                        </div>
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                 <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                 <input type="date" class="form-control bg-secondary text-light border-dark" id="dateOfBirth" name="dateOfBirth" value="<?php echo htmlspecialchars($prev_dob); ?>" required>
                             </div>
                             <div class="col-md-6 mb-3">
                                 <label for="country" class="form-label">Country</label>
                                 <input type="text" class="form-control bg-secondary text-light border-dark" id="country" name="country" placeholder="e.g., United Kingdom" value="<?php echo htmlspecialchars($prev_country); ?>" required>
                             </div>
                        </div>
                         <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control bg-secondary text-light border-dark" id="username" name="username" placeholder="Choose a username" value="<?php echo htmlspecialchars($prev_username); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control bg-secondary text-light border-dark" id="password" name="password" placeholder="Password" required>
                        </div>
                         <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control bg-secondary text-light border-dark" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                        </div>

                        <button type="submit" class="btn btn-danger btn-block w-100">Register</button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0">Already have an account? <a href="login_form.php" class="text-danger">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>

<!-- Optional: Add JS for client-side password match validation -->
<script>
    const form = document.getElementById('registerForm');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    form.addEventListener('submit', function(event) {
        if (password.value !== confirmPassword.value) {
            alert('Passwords do not match!');
            event.preventDefault(); // Prevent form submission
            confirmPassword.focus();
        }
    });
</script>