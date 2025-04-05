<?php
$pageTitle = "Home"; // Set the page title for the header
include 'templates/header.php'; // Use the new header
// require_once 'includes/functions.php'; // Already required in header.php

// Get programmes - limit to 3 for the main featured section
$allProgrammes = getAllProgrammes();
$featuredProgrammes = array_slice($allProgrammes, 0, 3); // Get first 3
// Ensure only PG-13 or lower are featured (optional, can be done in data prep)
// $featuredProgrammes = array_filter($featuredProgrammes, function($p) {
//    return in_array($p['ageRating'], ['G', 'PG', 'PG-13']);
// });

// Get top picks - sorting handled later, for now just use all
$topPicks = $allProgrammes;

?>

<!-- Search Bar -->
<div class="container search-bar">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="search.php" method="GET"> <!-- Point to a search results page -->
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search for movies, TV shows...">
                    <button class="btn btn-secondary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <h1>Welcome to PickFlix</h1>
        <p class="lead">Your go-to source for movie and TV show recommendations for Netflix</p>
        <a href="service.php" class="btn btn-primary">Learn About Netflix</a>
    </div>
</div>

<!-- Featured Movies & TV Shows -->
<div class="container">
    <h2 class="mb-4">Featured Recommendations</h2>
    <div class="row">
        <?php if (empty($featuredProgrammes)): ?>
            <p class="text-light">No featured programmes available at the moment.</p>
        <?php else: ?>
            <?php foreach ($featuredProgrammes as $programme): ?>
            <div class="col-md-4 d-flex align-items-stretch"> <!-- Added d-flex and align-items-stretch for equal height cards -->
                <div class="card movie-card w-100"> <!-- Added w-100 -->
                    <div class="movie-poster">
                        <?php // Use external image if local doesn't exist or use placeholder ?>
                        <img src="<?php echo htmlspecialchars($programme['coverImage'] ?? 'https://via.placeholder.com/300x450.png?text=No+Image'); ?>"
                             alt="<?php echo htmlspecialchars($programme['title']); ?> Poster">
                    </div>
                    <div class="card-body d-flex flex-column"> <!-- Flex column for button at bottom -->
                        <h5 class="card-title"><?php echo htmlspecialchars($programme['title']); ?></h5>
                        <p class="card-text movie-details">
                            <?php echo htmlspecialchars($programme['year']); ?> |
                            <?php echo htmlspecialchars(implode(', ', $programme['genres'] ?? [])); ?><br>
                            <?php if ($programme['type'] == 'movie'): ?>
                                Director: <?php echo htmlspecialchars($programme['director'] ?? 'N/A'); ?><br>
                            <?php else: ?>
                                Creator: <?php echo htmlspecialchars($programme['creator'] ?? 'N/A'); ?><br>
                            <?php endif; ?>
                            PickFlix Rating: <span class="movie-rating"><?php echo htmlspecialchars($programme['yourRating']); ?>/10</span>
                        </p>
                        <div class="mb-2">
                            <?php foreach ($programme['genres'] ?? [] as $genre): ?>
                                <span class="badge bg-secondary"><?php echo htmlspecialchars($genre); ?></span>
                            <?php endforeach; ?>
                        </div>
                         <a href="programme.php?id=<?php echo $programme['id']; ?>" class="btn btn-outline-secondary btn-sm mt-auto">View Details</a> <!-- mt-auto pushes button to bottom -->
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
         <?php endif; ?>
    </div>
</div>

<!-- Top Picks This Week (Simplified - Not a carousel for now) -->
<div class="container mt-5">
    <h2 class="mb-4"><a href="rankings.php" class="text-light" style="text-decoration: none;">Top Picks & Rankings <i class="fas fa-chevron-right fa-xs"></i></a></h2>
    <div class="row">
        <?php
            // Sort by your rating for top picks preview
            $sortedPicks = sortProgrammes($topPicks, 'yourRating', 'desc');
            $count = 0;
        ?>
         <?php if (empty($sortedPicks)): ?>
            <p class="text-light">No programmes available to rank.</p>
        <?php else: ?>
            <?php foreach ($sortedPicks as $programme):
                if ($count >= 4) break; // Show only first 4 top rated
            ?>
            <div class="col-md-3 d-flex align-items-stretch">
                <div class="card movie-card w-100">
                     <div class="movie-poster">
                          <img src="<?php echo htmlspecialchars($programme['coverImage'] ?? 'https://via.placeholder.com/300x450.png?text=No+Image'); ?>"
                             alt="<?php echo htmlspecialchars($programme['title']); ?> Poster">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($programme['title']); ?></h5>
                        <p class="card-text movie-details">
                            <?php echo htmlspecialchars($programme['year']); ?> | <?php echo htmlspecialchars($programme['ageRating']); ?><br>
                            Your Rating: <span class="movie-rating"><?php echo htmlspecialchars($programme['yourRating']); ?>/10</span>
                        </p>
                        <a href="programme.php?id=<?php echo $programme['id']; ?>" class="btn btn-outline-secondary btn-sm mt-auto">View Details</a>
                    </div>
                </div>
            </div>
            <?php
                $count++;
            endforeach;
        endif;
        ?>
    </div>
</div>


<?php include 'templates/footer.php'; // Use the new footer ?>