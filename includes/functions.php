<?php

define('DATA_DIR', __DIR__ . '/../data/'); // Define base data directory

// --- JSON Data Handling ---

/**
 * Loads and decodes JSON data from a file.
 * Returns an empty array if the file doesn't exist or is invalid.
 * @param string $fileName The name of the JSON file (without path).
 * @return array Decoded data as a PHP array.
 */
function loadJsonData(string $fileName): array {
    $filePath = DATA_DIR . $fileName;
    if (!file_exists($filePath)) {
        error_log("Data file not found: " . $filePath);
        return []; // Return empty array if file doesn't exist
    }
    $jsonData = file_get_contents($filePath);
    if ($jsonData === false) {
         error_log("Failed to read data file: " . $filePath);
         return [];
    }
    $data = json_decode($jsonData, true); // Decode as associative array
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Invalid JSON in file: " . $filePath . " - Error: " . json_last_error_msg());
        return []; // Return empty array if JSON is invalid
    }
    return is_array($data) ? $data : [];
}

/**
 * Encodes and saves PHP data to a JSON file with pretty printing and file locking.
 * @param string $fileName The name of the JSON file (without path).
 * @param array $data The PHP array data to save.
 * @return bool True on success, false on failure.
 */
function saveJsonData(string $fileName, array $data): bool {
    $filePath = DATA_DIR . $fileName;
    $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if ($jsonData === false) {
        error_log("Failed to encode JSON data for file: " . $fileName . " - Error: " . json_last_error_msg());
        return false;
    }

    $fileHandle = fopen($filePath, 'c'); // Open for writing; place pointer at beginning; truncate to zero length. If file doesn't exist, attempt to create it.
    if ($fileHandle === false) {
         error_log("Failed to open file for writing: " . $filePath);
         return false;
    }

    // Acquire exclusive lock
    if (flock($fileHandle, LOCK_EX)) {
        ftruncate($fileHandle, 0); // Truncate file to zero length
        fwrite($fileHandle, $jsonData); // Write the data
        fflush($fileHandle); // Flush output before releasing the lock
        flock($fileHandle, LOCK_UN); // Release the lock
    } else {
        error_log("Could not lock file for writing: " . $filePath);
        fclose($fileHandle);
        return false;
    }

    fclose($fileHandle);
    return true;
}

// --- Programme Functions ---

/**
 * Gets all programmes from programmes.json.
 * @return array Array of programme data.
 */
function getAllProgrammes(): array {
    return loadJsonData('programmes.json');
}

/**
 * Gets a specific programme by its ID.
 * @param int $id The ID of the programme.
 * @return array|null Programme data as an array, or null if not found.
 */
function getProgrammeById(int $id): ?array {
    $programmes = getAllProgrammes();
    foreach ($programmes as $programme) {
        if (isset($programme['id']) && $programme['id'] == $id) {
            return $programme;
        }
    }
    return null; // Return null if not found
}

// --- User Functions ---

 /**
 * Gets all users from users.json.
 * @return array Array of user data.
 */
function getAllUsers(): array {
    return loadJsonData('users.json');
}

/**
 * Gets a specific user by their username.
 * @param string $username The username to search for.
 * @return array|null User data as an array, or null if not found.
 */
function getUserByUsername(string $username): ?array {
    $users = getAllUsers();
    foreach ($users as $user) {
        if (isset($user['username']) && strtolower($user['username']) === strtolower($username)) {
             return $user;
        }
    }
    return null; // Return null if not found
}

/**
 * Adds a new user to users.json.
 * Handles ID generation. NO password hashing as requested.
 * @param array $userData Associative array of new user data (excluding ID and password hash).
 * @return bool True on success, false on failure.
 */
function addUser(array $userData): bool {
    $users = getAllUsers();

    // Check for username uniqueness (case-insensitive)
    foreach ($users as $existingUser) {
        if (isset($existingUser['username']) && strtolower($existingUser['username']) === strtolower($userData['username'])) {
            error_log("Username already exists: " . $userData['username']);
            return false; // Username already taken
        }
        if (isset($existingUser['email']) && strtolower($existingUser['email']) === strtolower($userData['email'])) {
            error_log("Email already exists: " . $userData['email']);
            return false; // Email already taken
        }
    }

    // Find the highest current ID to generate the next one
    $maxId = 0;
    foreach ($users as $user) {
        if (isset($user['id']) && $user['id'] > $maxId) {
            $maxId = $user['id'];
        }
    }
    $newId = $maxId + 1;

    $userData['id'] = $newId;
    // NO password_hash() as requested
    // Assume 'password' field is already in $userData

    $users[] = $userData; // Add the new user data

    return saveJsonData('users.json', $users);
}

// --- Review Functions ---

/**
 * Gets all reviews from reviews.json.
 * @return array Array of review data.
 */
function getAllReviews(): array {
    return loadJsonData('reviews.json');
}

/**
 * Gets reviews for a specific programme ID.
 * @param int $programmeId The ID of the programme.
 * @return array Array of matching review data.
 */
function getReviewsByProgrammeId(int $programmeId): array {
    $reviews = getAllReviews();
    $filteredReviews = [];
    foreach ($reviews as $review) {
        if (isset($review['programmeId']) && $review['programmeId'] == $programmeId) {
            $filteredReviews[] = $review;
        }
    }
    // Sort by timestamp descending (newest first)
    usort($filteredReviews, function($a, $b) {
        return ($b['timestamp'] ?? 0) <=> ($a['timestamp'] ?? 0);
    });
    return $filteredReviews;
}

/**
 * Gets reviews submitted by a specific user ID.
 * @param int $userId The ID of the user.
 * @return array Array of matching review data.
 */
function getReviewsByUserId(int $userId): array {
    $reviews = getAllReviews();
    $filteredReviews = [];
    foreach ($reviews as $review) {
        if (isset($review['userId']) && $review['userId'] == $userId) {
            $filteredReviews[] = $review;
        }
    }
     // Sort by timestamp descending (newest first)
    usort($filteredReviews, function($a, $b) {
         return ($b['timestamp'] ?? 0) <=> ($a['timestamp'] ?? 0);
    });
    return $filteredReviews;
}

/**
 * Adds a new review to reviews.json.
 * Handles review ID generation.
 * @param array $reviewData Associative array of new review data (excluding reviewId, timestamp).
 * @return bool True on success, false on failure.
 */
function addReview(array $reviewData): bool {
    $reviews = getAllReviews();

    // Find the highest current ID to generate the next one
    $maxId = 0;
    foreach ($reviews as $review) {
        if (isset($review['reviewId']) && $review['reviewId'] > $maxId) {
            $maxId = $review['reviewId'];
        }
    }
    $newId = $maxId + 1;

    $reviewData['reviewId'] = $newId;
    $reviewData['timestamp'] = time(); // Add timestamp

    $reviews[] = $reviewData; // Add the new review data

    return saveJsonData('reviews.json', $reviews);
}

/**
 * Calculates the average user rating for a programme.
 * @param int $programmeId The ID of the programme.
 * @return float|int The average rating, or 0 if no reviews.
 */
function calculateAverageRating(int $programmeId) {
    $reviews = getReviewsByProgrammeId($programmeId);
    if (empty($reviews)) {
        return 0;
    }

    $total = 0;
    $count = 0;
    foreach ($reviews as $review) {
         if (isset($review['rating']) && is_numeric($review['rating'])) {
            $total += (float)$review['rating'];
            $count++;
        }
    }

    return ($count > 0) ? round($total / $count, 1) : 0;
}

// --- Sorting Function (for Phase 4) ---

/**
 * Sorts an array of programmes by a specified field and order.
 * Handles average user rating calculation dynamically.
 * @param array $programmes Array of programme data to sort.
 * @param string $field Field to sort by ('title', 'year', 'yourRating', 'averageUserRating').
 * @param string $order 'asc' or 'desc'.
 * @return array Sorted array of programmes.
 */
function sortProgrammes(array $programmes, string $field = 'yourRating', string $order = 'desc'): array {
    $validFields = ['title', 'year', 'yourRating', 'averageUserRating', 'ageRating'];
    if (!in_array($field, $validFields)) {
        $field = 'yourRating'; // Default sort
    }

    $ascending = (strtolower($order) === 'asc');

    usort($programmes, function($a, $b) use ($field, $ascending) {
        if ($field == 'averageUserRating') {
            // Calculate average rating on the fly if sorting by it
            $valueA = calculateAverageRating($a['id'] ?? 0);
            $valueB = calculateAverageRating($b['id'] ?? 0);
        } else {
            $valueA = $a[$field] ?? null;
            $valueB = $b[$field] ?? null;
        }

         // Handle nulls or non-comparable types gracefully if necessary
         if ($valueA === null && $valueB === null) return 0;
         if ($valueA === null) return $ascending ? -1 : 1;
         if ($valueB === null) return $ascending ? 1 : -1;

        // Specific comparison for numeric vs string
        if (is_numeric($valueA) && is_numeric($valueB)) {
             $comparison = $valueA <=> $valueB;
        } else {
             $comparison = strcmp((string)$valueA, (string)$valueB);
        }


        return $ascending ? $comparison : -$comparison;
    });

    return $programmes;
}
?>