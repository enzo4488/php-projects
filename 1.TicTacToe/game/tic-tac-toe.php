<?php

include_once '../includes/database.php';
include_once '../game/game-functions.php';

//For debugging
$maxTurns = 10;
$currentTurn = 0;

// Let's assume these are your players
$playerX = "John";
$playerO = "Jane";

// Initialize the board as a 3x3 array
$board = [
    ['-', '-', '-'],
    ['-', '-', '-'],
    ['-', '-', '-']
];

// Function to display the board
function displayBoard($board) {
    foreach ($board as $row) {
        echo implode(' ', $row) . PHP_EOL;
    }
}

// Function to make a move
function makeMove($board, $row, $col, $player) {
    if ($board[$row][$col] === '-') {
        $board[$row][$col] = $player;
        return $board;
    }
    return null;
}

// Function to check for a winner
function checkWin($board, $player) {
    for ($i = 0; $i < 3; $i++) {
        if ($board[$i][0] === $player && $board[$i][1] === $player && $board[$i][2] === $player) {
            return true;
        }
    }
    for ($i = 0; $i < 3; $i++) {
        if ($board[0][$i] === $player && $board[1][$i] === $player && $board[2][$i] === $player) {
            return true;
        }
    }
    if ($board[0][0] === $player && $board[1][1] === $player && $board[2][2] === $player) {
        return true;
    }
    if ($board[0][2] === $player && $board[1][1] === $player && $board[2][0] === $player) {
        return true;
    }
    return false;
}

// Function to check for a draw
function checkDraw($board) {
    foreach ($board as $row) {
        foreach ($row as $cell) {
            if ($cell === '-') {
                return false;
            }
        }
    }
    return true;
}

// Main game loop
while (true) {
    if ($currentTurn >= $maxTurns) {
        echo "Max turns reached. Game over.\n";
        break;
    }

    // Display board
    displayBoard($board);

    // Player X move
    $tempBoard = makeMove($board, 0, 0, 'X');
    if ($tempBoard !== null) {
        $board = $tempBoard;
        if (checkWin($board, 'X')) {
            echo "Player X wins!" . PHP_EOL;
            updateUserStats($playerX, 1, 0, 0);  // 1 win for X
            updateUserStats($playerO, 0, 1, 0);  // 1 loss for O
            break;
        }
        if (checkDraw($board)) {
            echo "It's a draw!" . PHP_EOL;
            updateUserStats($playerX, 0, 0, 1);  // 1 draw for X
            updateUserStats($playerO, 0, 0, 1);  // 1 draw for O
            break;
        }
    } else {
        echo "Invalid move for Player X. Skipping turn.\n";
    }

    // Player O move
    $tempBoard = makeMove($board, 1, 1, 'O');
    if ($tempBoard !== null) {
        $board = $tempBoard;
        if (checkWin($board, 'O')) {
            echo "Player O wins!" . PHP_EOL;
            updateUserStats($playerO, 1, 0, 0);  // 1 win for O
            updateUserStats($playerX, 0, 1, 0);  // 1 loss for X
            break;
        }
        if (checkDraw($board)) {
            echo "It's a draw!" . PHP_EOL;
            updateUserStats($playerX, 0, 0, 1);  // 1 draw for X
            updateUserStats($playerO, 0, 0, 1);  // 1 draw for O
            break;
        }
    } else {
        echo "Invalid move for Player O. Skipping turn.\n";
    }

    $currentTurn++;
}