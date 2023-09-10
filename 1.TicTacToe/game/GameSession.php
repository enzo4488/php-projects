<?php

include_once '../includes/database.php';
include_once '../game/game-functions.php';
session_start();

// Initialize game board
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = [
        ['', '', ''],
        ['', '', ''],
        ['', '', ''],
    ];
}

// Initialize current player
if (!isset($_SESSION['currentPlayer'])) {
    $_SESSION['currentPlayer'] = 'X';  // X always starts
}

function makeMove($x, $y, $player) {
    global $board;
    if ($board[$x][$y] == '') {
        $board[$x][$y] = $player;
        return true;
    }
    return false;
}
