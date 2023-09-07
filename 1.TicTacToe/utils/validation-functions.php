<?php
// Function to validate username
function validateUsername($username) {
    if (empty($username) || strlen($username) < 4 || strlen($username) > 20) {
        return "Username must be between 4 and 20 characters.";
    }
    return null;
}

// Function to validate password
function validatePassword($password) {
    if (empty($password) || strlen($password) < 8) {
        return "Password must be at least 8 characters.";
    }
    return null;
}

// Function to validate email
function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
    return null;
}
