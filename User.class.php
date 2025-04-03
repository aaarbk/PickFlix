<?php
// Define the User class
class User {
    public $id;
    public $firstName;
    public $lastName;
    public $dateOfBirth;
    public $country;
    public $email;
    public $username;
    private $password; // Keep private if storing plain text, maybe less critical now
    public $preferredMovieId;
    public $preferredTVShowId;

    function __construct($id, $firstName, $lastName, $dateOfBirth, $country, $email, $username, $password, $preferredMovieId = null, $preferredTVShowId = null) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->country = $country;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password; // Store plain text password
        $this->preferredMovieId = $preferredMovieId;
        $this->preferredTVShowId = $preferredTVShowId;
    }

    // Method to verify password (simple comparison since no hashing requested)
    public function verifyPassword($passwordInput) {
        return $this->password === $passwordInput;
    }
}
?>