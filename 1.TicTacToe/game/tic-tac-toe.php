<?php

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
    // Check rows
    for ($i = 0; $i < 3; $i++) {
        if ($board[$i][0] === $player && $board[$i][1] === $player && $board[$i][2] === $player) {
            return true;
        }
    }

    // Check columns
    for ($i = 0; $i < 3; $i++) {
        if ($board[0][$i] === $player && $board[1][$i] === $player && $board[2][$i] === $player) {
            return true;
        }
    }

    // Check diagonals
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
    // Display board
    displayBoard($board);

    // Player X move
    // For demonstration, we'll set a fixed move
    $board = makeMove($board, 0, 0, 'X');
    if (checkWin($board, 'X')) {
        echo "Player X wins!" . PHP_EOL;
        break;
    }
    if (checkDraw($board)) {
        echo "It's a draw!" . PHP_EOL;
        break;
    }

    // Player O move
    // For demonstration, we'll set a fixed move
    $board = makeMove($board, 1, 1, 'O');
    if (checkWin($board, 'O')) {
        echo "Player O wins!" . PHP_EOL;
        break;
    }
    if (checkDraw($board)) {
        echo "It's a draw!" . PHP_EOL;
        break;
    }
}

?>
