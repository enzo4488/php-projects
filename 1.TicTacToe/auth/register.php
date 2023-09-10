<?php

include_once 'includes/database.php';
include_once 'auth/auth-functions.php';
include_once 'utils/validation-functions.php';

// Check if the user is already logged in
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to game or dashboard
    exit();
}

// Initialize error array to store validation errors
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    // Validate data using our new validation functions
    $username_error = validateUsername($username);
    $password_error = validatePassword($password);
    $email_error = validateEmail($email);

    if ($username_error) $errors[] = $username_error;
    if ($password_error) $errors[] = $password_error;
    if ($email_error) $errors[] = $email_error;

    // Only proceed with registration if there are no validation errors
    if (empty($errors)) {
        if (register($username, $password, $email)) {
            header('Location: login.php'); // Redirect to login page
            exit();
        } else {
            $error_message = "Registration failed. Please try again.";
        }
    } else {
        $error_message = implode('<br>', $errors);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <input type="submit" value="Register">
    </form>
    <?php
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>
</body>
</html>
