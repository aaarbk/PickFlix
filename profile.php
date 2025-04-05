<?php
// profile.php - ADDITIONAL UNIQUE APPLICATION VIEW
// Purpose: Allows logged-in users to view their profile information,
// see their submitted reviews, and set their favorite movie/TV show.
// Supported Functionality: Display profile data, list user reviews,
// form to update favorite movie/TV show preferences.

$pageTitle = "My Profile";
include 'templates/header.php'; // Includes session_start() and function loading
// require_once 'includes/functions.php'; // Already required in header.php

// --- Authentication Check ---
if (!isset($_SESSION['user_id'])) {
    header('Location: login_form.php?error=Please log in to view your profile.');
    exit();
}

// --- Load User Data (primarily from session) ---
$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];
$firstName = $_SESSION['first_name'] ?? 'N/A';
$lastName = $_SESSION['last_name'] ?? 'N/A';
$email = $_SESSION['email'] ?? 'N/A';
$country = $_SESSION['country'] ?? 'N/A';
$preferredMovieId = $_SESSION['preferred_movie'] ?? null;
$preferredTVShowId = $_SESSION['preferred_tvshow'] ?? null;

// --- Load User Reviews ---
$myReviews = getReviewsByUserId($userId);

// --- Load All Programmes (for favorite selection) ---
$allProgrammes = getAllProgrammes();

// --- Handle Profile Update (Favorites) ---
$updateMessage = '';
$updateError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_favorites'])) {
        $newFavMovieId = isset($_POST['favoriteMovie']) ? (int)$_POST['favoriteMovie'] : null;
        $newFavShowId = isset($_POST['favoriteShow']) ? (int)$_POST['favoriteShow'] : null;

         // Basic validation (check if ID exists if it's not 'none')
         $movieValid = ($newFavMovieId === null || getProgrammeById($newFavMovieId) !== null);
         $showValid = ($newFavShowId === null || getProgrammeById($newFavShowId) !== null);


        if ($movieValid && $showValid) {
             $updateData = [
                 'preferredMovieId' => $newFavMovieId === 0 ? null : $newFavMovieId, // Store null if 'None' selected
                 'preferredTVShowId' => $newFavShowId === 0 ? null : $newFavShowId   // Store null if 'None' selected
             ];
             if (updateUser($userId, $updateData)) {
                 $updateMessage = "Favorites updated successfully!";
                 // Update session variables immediately
                 $_SESSION['preferred_movie'] = $updateData['preferredMovieId'];
                 $_SESSION['preferred_tvshow'] = $updateData['preferredTVShowId'];
                 $preferredMovieId = $_SESSION['preferred_movie']; // Re-fetch for display
                 $preferredTVShowId = $_SESSION['preferred_tvshow']; // Re-fetch for display
             } else {
                 $updateError = "Failed to update favorites. Please try again.";
             }
        } else {
            $updateError = "Invalid movie or TV show selected.";
        }
    }
}

// Get names of current favorites
$currentFavMovie = $preferredMovieId ? getProgrammeById($preferredMovieId) : null;
$currentFavShow = $preferredTVShowId ? getProgrammeById($preferredTVShowId) : null;

?>

<div class="container mt-5 text-light">
    <h1 class="mb-4 text-danger">My Profile</h1>

    <!-- Display User Info -->
    <section class="mb-4">
        <h2><i class="fas fa-user-circle me-2"></i>Your Information</h2>
        <div class="card bg-dark border-secondary">
             <div class="card-body">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p><strong>Country:</strong> <?php echo htmlspecialchars($country); ?></p>
                <!-- Add Date of Birth if available and desired -->
                <!-- <p><strong>DOB:</strong> <?php echo htmlspecialchars($_SESSION['dateOfBirth'] ?? 'N/A'); ?></p> -->
            </div>
        </div>
    </section>

     <!-- Favorite Programmes -->
    <section class="mb-4">
         <h2><i class="fas fa-heart me-2 text-danger"></i>Your Favorites</h2>
         <div class="card bg-dark border-secondary">
             <div class="card-body">
                 <?php if ($updateMessage): ?>
                     <div class="alert alert-success"><?php echo $updateMessage; ?></div>
                 <?php endif; ?>
                 <?php if ($updateError): ?>
                     <div class="alert alert-danger"><?php echo $updateError; ?></div>
                 <?php endif; ?>

                 <p><strong>Current Favorite Movie:</strong> <?php echo $currentFavMovie ? htmlspecialchars($currentFavMovie['title']) : 'None selected'; ?></p>
                 <p><strong>Current Favorite TV Show:</strong> <?php echo $currentFavShow ? htmlspecialchars($currentFavShow['title']) : 'None selected'; ?></p>

                 <hr class="border-secondary">
                 <h5>Update Favorites:</h5>
                  <form action="profile.php" method="POST">
                      <div class="mb-3">
                          <label for="favoriteMovie" class="form-label">Select Favorite Movie:</label>
                          <select name="favoriteMovie" id="favoriteMovie" class="form-select bg-secondary text-light border-dark">
                              <option value="0" <?php echo ($preferredMovieId === null) ? 'selected' : ''; ?>>-- None --</option>
                              <?php foreach ($allProgrammes as $prog): ?>
                                  <?php if ($prog['type'] === 'movie'): ?>
                                      <option value="<?php echo $prog['id']; ?>" <?php echo ($preferredMovieId == $prog['id']) ? 'selected' : ''; ?>>
                                          <?php echo htmlspecialchars($prog['title']); ?>
                                      </option>
                                  <?php endif; ?>
                              <?php endforeach; ?>
                          </select>
                      </div>
                      <div class="mb-3">
                          <label for="favoriteShow" class="form-label">Select Favorite TV Show:</label>
                          <select name="favoriteShow" id="favoriteShow" class="form-select bg-secondary text-light border-dark">
                               <option value="0" <?php echo ($preferredTVShowId === null) ? 'selected' : ''; ?>>-- None --</option>
                              <?php foreach ($allProgrammes as $prog): ?>
                                  <?php if ($prog['type'] === 'tvshow'): ?>
                                       <option value="<?php echo $prog['id']; ?>" <?php echo ($preferredTVShowId == $prog['id']) ? 'selected' : ''; ?>>
                                          <?php echo htmlspecialchars($prog['title']); ?>
                                      </option>
                                  <?php endif; ?>
                              <?php endforeach; ?>
                          </select>
                      </div>
                       <button type="submit" name="update_favorites" class="btn btn-danger">Save Favorites</button>
                  </form>
             </div>
         </div>
    </section>


    <!-- Display User Reviews -->
    <section class="mb-4">
        <h2><i class="fas fa-comments me-2" id="my-reviews"></i>Your Reviews</h2>
        <?php if (empty($myReviews)): ?>
            <p>You haven't submitted any reviews yet.</p>
        <?php else: ?>
            <?php foreach ($myReviews as $review):
                $reviewedProgramme = getProgrammeById($review['programmeId']); // Get programme info for linking
            ?>
                <div class="card bg-dark border-secondary mb-3">
                    <div class="card-body">
                         <h6 class="card-title text-danger">
                             <a href="programme.php?id=<?php echo $review['programmeId']; ?>" class="text-danger">
                                 <?php echo htmlspecialchars($reviewedProgramme['title'] ?? 'Unknown Programme'); ?>
                             </a> -
                             <?php echo htmlspecialchars($review['title'] ?? 'Review'); ?> -
                             <span class="movie-rating"><?php echo htmlspecialchars($review['rating']); ?>/10</span>
                         </h6>
                         <p class="card-subtitle mb-2 text-muted">Reviewed on <?php echo date('Y-m-d H:i', $review['timestamp'] ?? time()); ?></p>
                         <p class="card-text"><?php echo nl2br(htmlspecialchars($review['content'])); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>


</div>

<?php include 'templates/footer.php'; ?>