<?php
function getDatabaseConnection() {
    // Database credentials
    $host = "localhost";
    $dbname = "tic_tac_toe";
    $username = "root";
    $password = "";
    
    try {
        // Create a new PDO instance
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        
        // Set error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $db;
    } catch (PDOException $e) {
        // Handle any errors
        die("Database connection failed: " . $e->getMessage());
    }
}
