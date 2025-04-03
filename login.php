<?php
require_once 'loadUsers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Flag to check if authentication is successful
    $authenticated = false;
    $currentUser = null;
    
    // Iterate over the users array to find the user
    foreach ($users as $user) {
        // Check if the username matches and the password is verified
        if ($user->username === $username && $user->verifyPassword($password)) {
            $authenticated = true;
            $currentUser = $user;
            break;
        }
    }
    
    if ($authenticated) {
        // Start a session
        session_start();
        
        // Authentication successful, set session variables
        $_SESSION['user_id'] = $currentUser->id;
        $_SESSION['username'] = $currentUser->username;
        $_SESSION['first_name'] = $currentUser->firstName;
        $_SESSION['last_name'] = $currentUser->lastName;
        $_SESSION['email'] = $currentUser->email;
        $_SESSION['country'] = $currentUser->country;
        $_SESSION['preferred_movie'] = $currentUser->preferredMovie;
        $_SESSION['preferred_tvshow'] = $currentUser->preferredTVShow;
        
        // Set session timeout in seconds (30 minutes)
        $_SESSION['timeout'] = time() + (30 * 60);
        
        // Redirect to master page after successful login
        header('Location: master.php');
        exit();
    } else {
        // If authentication fails
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <title>Login Failed</title>
          <!-- Bootstrap CSS -->
          <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
          <style>
            body {
              background-color: #141414;
              color: #ffffff;
              font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
              text-align: center;
              padding-top: 100px;
            }
            .error-container {
              max-width: 500px;
              margin: 0 auto;
              background-color: rgba(0, 0, 0, 0.75);
              padding: 30px;
              border-radius: 5px;
            }
            .btn-primary {
              background-color: #e50914;
              border: none;
              margin-top: 20px;
            }
            .btn-primary:hover {
              background-color: #f40612;
            }
          </style>
        </head>
        <body>
          <div class='error-container'>
            <h1>Login Failed</h1>
            <p>Invalid username or password.</p>
            <a href='index.php' class='btn btn-primary'>Try Again</a>
          </div>
        </body>
        </html>";
    }
} else {
    // If the request method is not POST, redirect to the login page
    header('Location: index.php');
    exit();
}
?>