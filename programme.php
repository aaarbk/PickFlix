<?php
// programme.php
require_once __DIR__ . '/includes/functions.php';

// Get Programme ID from URL
$programme_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Load the specific programme
$programme = getProgrammeById($programme_id);

// Set page title (or default if programme not found)
$pageTitle = $programme ? htmlspecialchars($programme['title']) : "Programme Not Found";
include 'templates/header.php';

// Load reviews for this programme
$userReviews = getReviewsByProgrammeId($programme_id);
$averageRating = calculateAverageRating($programme_id);

?>

<?php if ($programme): ?>
    <div class="container mt-4 text-light">
        <div class="row">
            <!-- Left Column: Poster & Basic Info -->
            <div class="col-md-4">
                 <div class="movie-poster mb-3">
                       <img src="<?php echo htmlspecialchars($programme['coverImage'] ?? 'https://via.placeholder.com/300x450.png?text=No+Image'); ?>"
                             alt="<?php echo htmlspecialchars($programme['title']); ?> Poster" class="img-fluid">
                 </div>
                 <h4>Key Facts</h4>
                 <ul class="list-unstyled movie-details">
                     <li><strong>Year:</strong> <?php echo htmlspecialchars($programme['year']); ?></li>
                     <li><strong>Genre:</strong> <?php echo htmlspecialchars(implode(', ', $programme['genres'] ?? [])); ?></li>
                     <?php if ($programme['type'] == 'movie'): ?>
                         <li><strong>Director:</strong> <?php echo htmlspecialchars($programme['director'] ?? 'N/A'); ?></li>
                         <li><strong>Duration:</strong> <?php echo htmlspecialchars($programme['duration'] ?? 'N/A'); ?></li>
                     <?php else: ?>
                         <li><strong>Creator:</strong> <?php echo htmlspecialchars($programme['creator'] ?? 'N/A'); ?></li>
                          <li><strong>Avg. Duration:</strong> <?php echo htmlspecialchars($programme['duration'] ?? 'N/A'); ?></li>
                     <?php endif; ?>
                     <li><strong>Stars:</strong> <?php echo htmlspecialchars(implode(', ', $programme['stars'] ?? [])); ?></li>
                     <li><strong>Age Rating:</strong> <?php echo htmlspecialchars($programme['ageRating']); ?></li>
                      <li><strong>Your Rating:</strong> <span class="movie-rating"><?php echo htmlspecialchars($programme['yourRating']); ?>/10</span></li>
                      <li><strong>Avg. User Rating:</strong> <span class="movie-rating"><?php echo $averageRating > 0 ? htmlspecialchars($averageRating) : 'N/A'; ?>/10</span></li>
                 </ul>
            </div>

            <!-- Right Column: Details, Reviews -->
            <div class="col-md-8">
                <h1 class="text-danger"><?php echo htmlspecialchars($programme['title']); ?></h1>
                <p class="lead"><?php echo htmlspecialchars($programme['description']); ?></p>

                <hr class="border-secondary">

                <h4><i class="fas fa-star me-1 text-warning"></i> Your Review</h4>
                <p><strong>Rating: <span class="movie-rating"><?php echo htmlspecialchars($programme['yourRating']); ?>/10</span></strong></p>
                <p><em><?php echo nl2br(htmlspecialchars($programme['yourReview'] ?? 'No editorial review available.')); ?></em></p>


                <hr class="border-secondary">

                <h4><i class="fas fa-link me-1"></i> Official External Reviews</h4>
                 <?php if (empty($programme['externalReviews'])): ?>
                     <p>No official external reviews linked.</p>
                <?php else: ?>
                    <ul class="list-group list-group-flush bg-transparent">
                        <?php foreach ($programme['externalReviews'] as $extReview): ?>
                            <li class="list-group-item bg-transparent text-light border-secondary">
                                <a href="<?php echo htmlspecialchars($extReview['url']); ?>" target="_blank" class="text-light">
                                    <strong><?php echo htmlspecialchars($extReview['source']); ?></strong>
                                    <?php if (isset($extReview['rating'])): ?>
                                         - Rating: <?php echo htmlspecialchars($extReview['rating']); ?>/10
                                    <?php endif; ?>
                                </a><br>
                                <small><em>"<?php echo htmlspecialchars($extReview['excerpt']); ?>"</em></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>


                 <hr class="border-secondary mt-4">

                <h4><i class="fas fa-comments me-1"></i> User Reviews</h4>
                <?php if (empty($userReviews)): ?>
                    <p>No user reviews yet for <?php echo htmlspecialchars($programme['title']); ?>.</p>
                <?php else: ?>
                     <p>Average User Rating: <span class="movie-rating"><?php echo htmlspecialchars($averageRating); ?>/10</span></p>
                    <?php foreach ($userReviews as $review): ?>
                        <div class="card bg-dark border-secondary mb-3">
                            <div class="card-body">
                                 <h6 class="card-title text-danger"><?php echo htmlspecialchars($review['title'] ?? 'Review'); ?> - <span class="movie-rating"><?php echo htmlspecialchars($review['rating']); ?>/10</span></h6>
                                 <p class="card-subtitle mb-2 text-muted">By <?php echo htmlspecialchars($review['username']); ?> on <?php echo date('Y-m-d H:i', $review['timestamp'] ?? time()); ?></p>
                                 <p class="card-text"><?php echo nl2br(htmlspecialchars($review['content'])); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <hr class="border-secondary mt-4">

				  <!-- Review Submission Form -->
				  <div id="review-form-section" class="mt-4">
				      <h4><i class="fas fa-pencil-alt me-1"></i> Add Your Review</h4>
				      <?php if ($is_logged_in): ?>
				          <?php
				              // Check for submission errors passed back
				              $review_error = $_GET['review_error'] ?? '';
				              $review_success = $_GET['review_success'] ?? '';
				          ?>
				          <?php if ($review_error): ?>
				              <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars(urldecode($review_error)); ?></div>
				          <?php endif; ?>
				          <?php if ($review_success): ?>
				              <div class="alert alert-success" role="alert"><?php echo htmlspecialchars(urldecode($review_success)); ?></div>
				          <?php endif; ?>

				          <form action="submit_review.php" method="POST" id="reviewForm">
				              <input type="hidden" name="programmeId" value="<?php echo $programme['id']; ?>">
				              <div class="mb-3">
				                  <label for="rating" class="form-label">Your Rating (1-10)</label>
				                  <select class="form-select bg-secondary text-light border-dark" id="rating" name="rating" required>
				                      <option value="" selected disabled>Select rating</option>
				                      <?php for ($i = 10; $i >= 1; $i--): ?>
				                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				                      <?php endfor; ?>
				                  </select>
				              </div>
				              <div class="mb-3">
				                  <label for="reviewTitle" class="form-label">Review Title</label>
				                  <input type="text" class="form-control bg-secondary text-light border-dark" id="reviewTitle" name="reviewTitle" placeholder="e.g., Absolutely fantastic!" required>
				              </div>
				              <div class="mb-3">
				                  <label for="reviewContent" class="form-label">Your Review</label>
				                  <textarea class="form-control bg-secondary text-light border-dark" id="reviewContent" name="reviewContent" rows="4" placeholder="Share your thoughts..." required></textarea>
				              </div>
				              <button type="submit" class="btn btn-danger">Submit Review</button>
				          </form>
				      <?php else: ?>
				          <p><a href="login_form.php?redirect=<?php echo urlencode('programme.php?id=' . $programme_id); ?>" class="text-danger">Log in</a> to add your review.</p>
				      <?php endif; ?>
				 </div>


            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger" role="alert">
        Programme not found. Please check the ID and try again. <a href="index.php">Go back home</a>.
    </div>
<?php endif; ?>


<?php include 'templates/footer.php'; ?>