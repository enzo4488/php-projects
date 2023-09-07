<?php
// Initialize session if not already initialized
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection (This assumes that you have a database.php file that returns a PDO object)
include_once 'database.php';
$db = getDatabaseConnection();

// Function to handle user login
function login($username, $password) {
    global $db;
    
    $query = $db->prepare("SELECT * FROM users WHERE username = :username");
    $query->bindParam(":username", $username);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }
    
    return false;
}

// Function to handle user registration
function register($username, $password, $email) {
    global $db;
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $query = $db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
    $query->bindParam(":username", $username);
    $query->bindParam(":password", $hashedPassword);
    $query->bindParam(":email", $email);
    
    return $query->execute();
}

// Function to handle user logout
function logout() {
    session_unset();
    session_destroy();
}
