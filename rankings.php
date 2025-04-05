<?php
$pageTitle = "Programme Rankings"; // Set page title
include 'templates/header.php';
// require_once 'includes/functions.php'; // Already required in header.php

// Get sort parameters from URL, set defaults
$sort_field = $_GET['sort'] ?? 'yourRating'; // Default sort field
$sort_order = $_GET['order'] ?? 'desc'; // Default sort order
$valid_fields = ['title', 'year', 'yourRating', 'averageUserRating', 'ageRating']; // Allowed sort fields

// Validate sort field
if (!in_array($sort_field, $valid_fields)) {
    $sort_field = 'yourRating';
}

// Validate sort order
if (strtolower($sort_order) !== 'asc' && strtolower($sort_order) !== 'desc') {
    $sort_order = 'desc';
}

// Determine the order for the *next* click on a header
$next_order = ($sort_order === 'asc' ? 'desc' : 'asc');

// Load all programmes
$allProgrammes = getAllProgrammes();

// Calculate average user ratings and add to programme data (for sorting/display)
// Note: This could be slow for many reviews/programmes; optimization might be needed in a real app.
foreach ($allProgrammes as $key => $programme) {
    $allProgrammes[$key]['averageUserRating'] = calculateAverageRating($programme['id']);
}


// Sort the programmes array using the helper function
$sortedProgrammes = sortProgrammes($allProgrammes, $sort_field, $sort_order);


// Helper function to generate sorting links for table headers
function sort_link($label, $field, $current_field, $current_order, $next_order) {
    $order_icon = '';
    $link_order = 'asc'; // Default order for a new field click
    if ($field === $current_field) {
        $order_icon = ($current_order === 'asc' ? '<i class="fas fa-sort-up ms-1"></i>' : '<i class="fas fa-sort-down ms-1"></i>');
        $link_order = $next_order; // Toggle order if clicking the same field
    }
    return "<a href=\"?sort={$field}&order={$link_order}\" class=\"text-danger\">{$label}{$order_icon}</a>";
}

?>

<div class="container mt-5 text-light">
    <h1 class="mb-4 text-danger">Programme Rankings</h1>
    <p>Click on column headers to sort.</p>

    <div class="table-responsive">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th><?php echo sort_link('Title', 'title', $sort_field, $sort_order, $next_order); ?></th>
                    <th><?php echo sort_link('Year', 'year', $sort_field, $sort_order, $next_order); ?></th>
                    <th>Genres</th>
                    <th><?php echo sort_link('Age', 'ageRating', $sort_field, $sort_order, $next_order); ?></th>
                    <th><?php echo sort_link('Your Rating', 'yourRating', $sort_field, $sort_order, $next_order); ?></th>
                    <th><?php echo sort_link('Avg. User Rating', 'averageUserRating', $sort_field, $sort_order, $next_order); ?></th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($sortedProgrammes)): ?>
                    <tr>
                        <td colspan="7" class="text-center">No programmes to display.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($sortedProgrammes as $programme): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($programme['title']); ?></td>
                            <td><?php echo htmlspecialchars($programme['year']); ?></td>
                            <td><?php echo htmlspecialchars(implode(', ', $programme['genres'] ?? [])); ?></td>
                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($programme['ageRating']); ?></span></td>
                            <td><span class="movie-rating"><?php echo htmlspecialchars($programme['yourRating']); ?>/10</span></td>
                            <td>
                                <span class="movie-rating">
                                    <?php echo $programme['averageUserRating'] > 0 ? htmlspecialchars($programme['averageUserRating']) : 'N/A'; ?>/10
                                </span>
                            </td>
                             <td><a href="programme.php?id=<?php echo $programme['id']; ?>" class="btn btn-sm btn-outline-light">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<?php include 'templates/footer.php'; ?>