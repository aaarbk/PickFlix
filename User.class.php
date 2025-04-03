<?php
// User class for Movie/TV Show Recommendation System
class User {
    public $id;
    public $firstName;
    public $lastName;
    public $dateOfBirth;
    public $country;
    public $email;
    public $username;
    public $password;
    public $preferredMovie;
    public $preferredTVShow;
    
    function __construct($id, $firstName, $lastName, $dateOfBirth, $country, $email, $username, $password, $preferredMovie = null, $preferredTVShow = null) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->country = $country;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->preferredMovie = $preferredMovie;
        $this->preferredTVShow = $preferredTVShow;
    }
    
    // Method to verify password
    public function verifyPassword($password) {
        return $this->password === $password;
    }
    
    // Method to get full name
    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }
    
    // Method to update preferred movie
    public function updatePreferredMovie($movieName) {
        $this->preferredMovie = $movieName;
    }
    
    // Method to update preferred TV show
    public function updatePreferredTVShow($tvShowName) {
        $this->preferredTVShow = $tvShowName;
    }
}
?>