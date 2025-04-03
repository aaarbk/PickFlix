<?php
// Programme class for Movie/TV Show Recommendation System
class Programme {
    public $id;
    public $title;
    public $year;
    public $genres;
    public $director;
    public $creator;
    public $stars;
    public $description;
    public $coverImage;
    public $type; // 'movie' or 'tvshow'
    public $ageRating;
    public $duration;
    public $yourRating;
    public $externalReviews;
    public $userReviews;
    
    function __construct($id, $title, $year, $genres, $director, $stars, $description, $coverImage, $type, $ageRating, $duration, $yourRating, $externalReviews = [], $userReviews = [], $creator = null) {
        $this->id = $id;
        $this->title = $title;
        $this->year = $year;
        $this->genres = $genres;
        $this->director = $director;
        $this->creator = $creator;
        $this->stars = $stars;
        $this->description = $description;
        $this->coverImage = $coverImage;
        $this->type = $type;
        $this->ageRating = $ageRating;
        $this->duration = $duration;
        $this->yourRating = $yourRating;
        $this->externalReviews = $externalReviews;
        $this->userReviews = $userReviews;
    }
    
    // Method to get formatted genres as a string
    public function getGenresString() {
        return implode(', ', $this->genres);
    }
    
    // Method to get formatted stars as a string
    public function getStarsString() {
        return implode(', ', $this->stars);
    }
    
    // Method to add a user review
    public function addUserReview($userId, $username, $rating, $title, $content, $date) {
        $this->userReviews[] = [
            'userId' => $userId,
            'username' => $username,
            'rating' => $rating,
            'title' => $title,
            'content' => $content,
            'date' => $date
        ];
    }
    
    // Method to get average user rating
    public function getAverageUserRating() {
        if (empty($this->userReviews)) {
            return 0;
        }
        
        $total = 0;
        foreach ($this->userReviews as $review) {
            $total += $review['rating'];
        }
        
        return round($total / count($this->userReviews), 1);
    }
}

// Define the global array to store Programme objects
$programmes = array();

// Sample external reviews
$lastBreathExternalReviews = [
    [
        'source' => 'IMDb',
        'url' => 'https://www.imdb.com/title/tt8079106/',
        'rating' => 8.2,
        'excerpt' => 'A gripping true story of survival against impossible odds.'
    ],
    [
        'source' => 'Rotten Tomatoes',
        'url' => 'https://www.rottentomatoes.com/m/last_breath_2019',
        'rating' => 9.0,
        'excerpt' => 'Tense, thrilling, and emotionally resonant.'
    ],
    [
        'source' => 'The Guardian',
        'url' => 'https://www.theguardian.com/film/2019/apr/04/last-breath-review-deep-sea-diving-disaster-documentary',
        'rating' => 8.5,
        'excerpt' => 'A nail-biting documentary that plays like a thriller.'
    ]
];

$electricStateExternalReviews = [
    [
        'source' => 'IMDb',
        'url' => 'https://www.imdb.com/title/tt15239678/',
        'rating' => 8.7,
        'excerpt' => 'A visually stunning sci-fi adventure with heart.'
    ],
    [
        'source' => 'Rotten Tomatoes',
        'url' => 'https://www.rottentomatoes.com/m/the_electric_state',
        'rating' => 8.8,
        'excerpt' => 'The Russo brothers deliver another hit with this imaginative adaptation.'
    ],
    [
        'source' => 'Variety',
        'url' => 'https://variety.com/2025/film/reviews/the-electric-state-review-1235821463/',
        'rating' => 8.5,
        'excerpt' => 'Millie Bobby Brown shines in this retro-futuristic adventure.'
    ]
];

$gabrielExternalReviews = [
    [
        'source' => 'IMDb',
        'url' => 'https://www.imdb.com/title/tt29661387/',
        'rating' => 8.4,
        'excerpt' => 'A magical animated series that captivates viewers of all ages.'
    ],
    [
        'source' => 'Rotten Tomatoes',
        'url' => 'https://www.rottentomatoes.com/tv/gabriel_and_the_guardians',
        'rating' => 8.9,
        'excerpt' => 'Stunning animation and compelling storytelling make this a must-watch.'
    ],
    [
        'source' => 'Animation Magazine',
        'url' => 'https://www.animationmagazine.net/reviews/gabriel-and-the-guardians-review/',
        'rating' => 9.0,
        'excerpt' => 'One of the most visually impressive animated series of the year.'
    ]
];

// Sample user reviews (empty for now, will be populated when users submit reviews)
$userReviews = [];

// Create Programme objects
// Format: id, title, year, genres array, director, stars array, description, coverImage, type, ageRating, duration, yourRating, externalReviews, userReviews, creator
$programmes[] = new Programme(
    1,
    'Last Breath',
    2025,
    ['Drama', 'Thriller'],
    'Alex Parkinson',
    ['Woody Harrelson', 'Simu Liu', 'Finn Cole'],
    '"Last Breath" is a gripping true story that follows seasoned deep-sea divers battling the raging elements to rescue a crew mate trapped hundreds of feet below the ocean\'s surface. The film combines heart-pounding tension with human resilience and teamwork.',
    'images/last_breath_cover.jpg',
    'movie',
    'PG-13',
    '118 min',
    9.2,
    $lastBreathExternalReviews,
    $userReviews
);

$programmes[] = new Programme(
    2,
    'The Electric State',
    2025,
    ['Sci-Fi', 'Adventure'],
    'Anthony Russo, Joe Russo',
    ['Millie Bobby Brown', 'Chris Pratt', 'Woody Harrelson'],
    'Set in a retro-futuristic world, "The Electric State" follows an orphaned teen who embarks on a journey with a mysterious robot to find her long-lost brother. Along the way, she teams up with a smuggler and his wisecracking sidekick in this visually stunning and emotionally resonant adventure.',
    'images/electric_state_cover.jpg',
    'movie',
    'PG-13',
    '142 min',
    9.0,
    $electricStateExternalReviews,
    $userReviews
);

$programmes[] = new Programme(
    3,
    'Gabriel and the Guardians',
    2025,
    ['Fantasy', 'Adventure', 'Animation'],
    null,
    ['Dee Bradley Baker', 'Ja\'Siah Young', 'Gracen Newton'],
    '"Gabriel and the Guardians" is an epic anime fantasy series that follows Gabriel and his team of magical guardians as they protect their world from dark forces. With stunning animation and heartfelt storytelling, it appeals to audiences of all ages.',
    'images/gabriel_guardians_cover.jpg',
    'tvshow',
    'PG',
    '25 min per episode',
    8.8,
    $gabrielExternalReviews,
    $userReviews,
    'Animation Studio' // Creator field for TV shows
);

// Function to get a programme by ID
function getProgrammeById($id) {
    global $programmes;
    foreach ($programmes as $programme) {
        if ($programme->id == $id) {
            return $programme;
        }
    }
    return null;
}

// Function to get all programmes
function getAllProgrammes() {
    global $programmes;
    return $programmes;
}

// Function to get programmes by type
function getProgrammesByType($type) {
    global $programmes;
    $result = [];
    foreach ($programmes as $programme) {
        if ($programme->type == $type) {
            $result[] = $programme;
        }
    }
    return $result;
}

// Function to sort programmes by a specific field
function sortProgrammesBy($field, $ascending = true) {
    global $programmes;
    $sortedProgrammes = $programmes;
    
    usort($sortedProgrammes, function($a, $b) use ($field, $ascending) {
        if ($field == 'averageUserRating') {
            $valueA = $a->getAverageUserRating();
            $valueB = $b->getAverageUserRating();
        } else {
            $valueA = $a->$field;
            $valueB = $b->$field;
        }
        
        if ($valueA == $valueB) {
            return 0;
        }
        
        if ($ascending) {
            return ($valueA < $valueB) ? -1 : 1;
        } else {
            return ($valueA > $valueB) ? -1 : 1;
        }
    });
    
    return $sortedProgrammes;
}
?>
