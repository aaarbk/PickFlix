<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PickFlix - Your Movie and TV Show Recommendation Source</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
        }
        .hero-section {
            background-color: #e9ecef;
            padding: 3rem 0;
            text-align: center;
            margin-bottom: 2rem;
        }
        .movie-card {
            margin-bottom: 2rem;
            transition: transform 0.3s;
            height: 100%;
        }
        .movie-card:hover {
            transform: scale(1.03);
        }
        .movie-poster {
            height: 300px;
            background-color: #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .movie-poster img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .movie-info {
            padding: 1rem;
        }
        .movie-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .movie-details {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .movie-rating {
            font-weight: bold;
            color: #ff8c00;
        }
        .search-bar {
            margin: 1.5rem 0;
        }
        .footer {
            background-color: #e9ecef;
            padding: 1rem 0;
            text-align: center;
            margin-top: 2rem;
        }
        .footer a {
            color: #6c757d;
            margin: 0 0.5rem;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .carousel-control-next, 
        .carousel-control-prev {
            width: 5%;
        }
        .badge {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php
    // Include the programme data
    require_once 'loadProgrammes.php';
    
    // Get all programmes
    $allProgrammes = getAllProgrammes();
    ?>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">PickFlix</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">TV Shows</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rankings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Service Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Bar -->
    <div class="container search-bar">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for movies, TV shows, actors...">
                    <button class="btn btn-secondary" type="button">Search</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1>Welcome to PickFlix</h1>
            <p class="lead">Your go-to source for movie and TV show recommendations</p>
            <a href="#" class="btn btn-primary">Learn About Our Service</a>
        </div>
    </div>

    <!-- Featured Movies & TV Shows -->
    <div class="container">
        <h2 class="mb-4">Featured Movies & TV Shows</h2>
        <div class="row">
            <?php foreach ($allProgrammes as $programme): ?>
            <div class="col-md-4">
                <div class="card movie-card">
                    <div class="movie-poster">
                        <?php if (file_exists($programme->coverImage)): ?>
                            <img src="<?php echo $programme->coverImage; ?>" alt="<?php echo $programme->title; ?> Poster">
                        <?php else: ?>
                            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                <i class="fas <?php echo $programme->type == 'movie' ? 'fa-film' : 'fa-tv'; ?> fa-3x mb-2"></i>
                                <span><?php echo $programme->title; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $programme->title; ?></h5>
                        <p class="card-text movie-details">
                            <?php echo $programme->year; ?> | 
                            <?php echo $programme->getGenresString(); ?><br>
                            <?php if ($programme->type == 'movie'): ?>
                                Director: <?php echo $programme->director; ?><br>
                            <?php else: ?>
                                Creator: <?php echo $programme->creator ?? 'Not specified'; ?><br>
                            <?php endif; ?>
                            PickFlix Rating: <span class="movie-rating"><?php echo $programme->yourRating; ?>/10</span>
                        </p>
                        <div class="mb-2">
                            <?php foreach ($programme->genres as $genre): ?>
                                <span class="badge bg-secondary"><?php echo $genre; ?></span>
                            <?php endforeach; ?>
                        </div>
                        <a href="programme.php?id=<?php echo $programme->id; ?>" class="btn btn-outline-secondary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Top Picks This Week -->
    <div class="container mt-5">
        <h2 class="mb-4">Top Picks This Week</h2>
        <div class="row">
            <div class="col-12">
                <div id="topPicksCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <?php 
                                // Sort programmes by rating (descending)
                                $topPicks = sortProgrammesBy('yourRating', false);
                                $count = 0;
                                foreach ($topPicks as $programme): 
                                    if ($count >= 4) break; // Show only 4 items
                                ?>
                                <div class="col-md-3">
                                    <div class="card movie-card">
                                        <div class="movie-poster">
                                            <?php if (file_exists($programme->coverImage)): ?>
                                                <img src="<?php echo $programme->coverImage; ?>" alt="<?php echo $programme->title; ?> Poster">
                                            <?php else: ?>
                                                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                                    <i class="fas <?php echo $programme->type == 'movie' ? 'fa-film' : 'fa-tv'; ?> fa-3x mb-2"></i>
                                                    <span><?php echo $programme->title; ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $programme->title; ?></h5>
                                            <p class="card-text movie-details">
                                                <?php echo $programme->year; ?> | <?php echo $programme->ageRating; ?><br>
                                                PickFlix Rating: <span class="movie-rating"><?php echo $programme->yourRating; ?>/10</span>
                                            </p>
                                            <a href="programme.php?id=<?php echo $programme->id; ?>" class="btn btn-outline-secondary btn-sm">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    $count++;
                                endforeach; 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> PickFlix. All rights reserved.</p>
            <div>
                <a href="#">About Us</a>
                <a href="#">Contact</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
