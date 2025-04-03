<?php
require_once 'User.class.php';
// Define the global array to store User objects
$users = array();

// Sample existing users
// Format: id, firstName, lastName, dateOfBirth, country, email, username, password, preferredMovie, preferredTVShow
$users[] = new User(1, 'John', 'Doe', '1990-05-15', 'United States', 'john.doe@example.com', 'johndoe', 'password123', 'Toy Story', 'Avatar: The Last Airbender');
$users[] = new User(2, 'Jane', 'Smith', '1985-11-20', 'Canada', 'jane.smith@example.com', 'janesmith', 'pass456', 'Up', 'Gravity Falls');
$users[] = new User(3, 'Emma', 'Johnson', '1992-07-10', 'United Kingdom', 'emma.j@example.com', 'emma', 'emma123', 'Inside Out', 'The Dragon Prince');
$users[] = new User(4, 'Mike', 'Wilson', '1988-03-25', 'Australia', 'mike.w@example.com', 'mike', 'mike789', 'The Incredibles', 'Steven Universe');
$users[] = new User(5, 'Sarah', 'Brown', '1995-09-30', 'New Zealand', 'sarah.b@example.com', 'sarah', 'sarah123', 'Coco', 'She-Ra and the Princesses of Power');

?>