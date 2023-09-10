<?php
include_once '../includes/database.php';

// Increment stats based on outcome
function updateUserStats($username, $outcome) {
    $db = getDatabaseConnection();

    $stats = fetchUserStats($username);

    switch ($outcome) {
        case 'win':
            $stats['wins'] += 1;
            break;
        case 'loss':
            $stats['losses'] += 1;
            break;
        case 'draw':
            $stats['draws'] += 1;
            break;
    }

    $sql = "UPDATE users SET wins = :wins, losses = :losses, draws = :draws WHERE username = :username";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':wins', $stats['wins'], PDO::PARAM_INT);
    $stmt->bindParam(':losses', $stats['losses'], PDO::PARAM_INT);
    $stmt->bindParam(':draws', $stats['draws'], PDO::PARAM_INT);

    return $stmt->execute();
}

function fetchUserStats($username) {
    $db = getDatabaseConnection();

    $sql = "SELECT wins, losses, draws FROM users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
