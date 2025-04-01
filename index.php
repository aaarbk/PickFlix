<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PickFlix - Your Movie and TV Show Recommendation Source</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }
        .movie-card:hover {
            transform: scale(1.03);
        }
        .movie-poster {
            height: 200px;
            background-color: #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
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
    </style>
</head>
<body>
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
                        <a class="nav-link" href="#">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Login</a>
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
            <!-- Movie Card 1 -->
            <div class="col-md-4">
                <div class="card movie-card">
                    <div class="movie-poster">
                        <svg width="50" height="50" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Inception</h5>
                        <p class="card-text movie-details">2010 | Action, Sci-Fi<br>Director: Christopher Nolan<br>PickFlix Rating: 9.2/10</p>
                        <a href="#" class="btn btn-outline-secondary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Movie Card 2 -->
            <div class="col-md-4">
                <div class="card movie-card">
                    <div class="movie-poster">
                        <svg width="50" height="50" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Stranger Things</h5>
                        <p class="card-text movie-details">2016 | Drama, Horror<br>Creators: The Duffer Brothers<br>PickFlix Rating: 9.1/10</p>
                        <a href="#" class="btn btn-outline-secondary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Movie Card 3 -->
            <div class="col-md-4">
                <div class="card movie-card">
                    <div class="movie-poster">
                        <svg width="50" height="50" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">The Dark Knight</h5>
                        <p class="card-text movie-details">2008 | Action, Crime<br>Director: Christopher Nolan<br>PickFlix Rating: 9.1/10</p>
                        <a href="#" class="btn btn-outline-secondary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
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
                                <!-- Movie 1 -->
                                <div class="col-md-3">
                                    <div class="card movie-card">
                                        <div class="movie-poster">
                                            <svg width="30" height="30" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                                            </svg>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Toy Story 4</h6>
                                            <p class="card-text small">Animation | Family<br>PickFlix: 9.4/10</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Movie 2 -->
                                <div class="col-md-3">
                                    <div class="card movie-card">
                                        <div class="movie-poster">
                                            <svg width="30" height="30" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                                            </svg>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">The Godfather</h6>
                                            <p class="card-text small">Crime | Drama<br>PickFlix: 9.3/10</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Movie 3 -->
                                <div class="col-md-3">
                                    <div class="card movie-card">
                                        <div class="movie-poster">
                                            <svg width="30" height="30" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                                            </svg>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Breaking Bad</h6>
                                            <p class="card-text small">Crime | Drama<br>PickFlix: 9.5/10</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Movie 4 -->
                                <div class="col-md-3">
                                    <div class="card movie-card">
                                        <div class="movie-poster">
                                            <svg width="30" height="30" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                                            </svg>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Pulp Fiction</h6>
                                            <p class="card-text small">Crime | Drama<br>PickFlix: 9.0/10</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#topPicksCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#topPicksCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> PickFlix | 
                <a href="#">About</a> | 
                <a href="#">Terms</a> | 
                <a href="#">Privacy</a> | 
                <a href="#">Contact Us</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
