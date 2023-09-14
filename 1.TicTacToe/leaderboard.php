<?php

include_once 'includes/database.php';
$userStats = fetchUserStats($username);
echo "Wins: " . $userStats['wins'];
echo "Losses: " . $userStats['losses'];
echo "Draws: " . $userStats['draws'];
