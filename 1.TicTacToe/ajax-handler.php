<?php
session_start();  // Start the session first
error_log(file_get_contents('php://input')); //Debugging

// Check for reset
if (isset($_GET['reset'])) {
    $_SESSION['board'] = [
        ['-', '-', '-'],
        ['-', '-', '-'],
        ['-', '-', '-']
    ];
    $_SESSION['currentPlayer'] = 'X';
    echo json_encode(['status' => 'success', 'message' => 'Board reset']);
    exit();
}

header('Content-Type: application/json'); // Set the header

include_once 'C:/Users/Enzo/Desktop/Xampp/htdocs/php-projects/1.TicTacToe/game/tic-tac-toe.php';

// Initialize the board and current player if they don't exist in the session
if (!isset($_SESSION['board']) || !isset($_SESSION['currentPlayer'])) {
    $_SESSION['board'] = [
        ['-', '-', '-'],
        ['-', '-', '-'],
        ['-', '-', '-']
    ];
    $_SESSION['currentPlayer'] = 'X';
}

$data = json_decode(file_get_contents('php://input'), true);
if ($data === null) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
    exit();
}

if (!isset($data['row'], $data['col'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
    exit();
}

$row = $data['row'];
$col = $data['col'];
$player = $_SESSION['currentPlayer'];  // Use the current player from the session

// Check if the cell is already occupied
if ($_SESSION['board'][$row][$col] !== '-') {
    echo json_encode(['status' => 'error', 'message' => 'Cell already occupied']);
    exit();
}

// Retrieve the board from the session
$board = $_SESSION['board'];

$newBoard = makeMove($board, $row, $col, $player);
if ($newBoard !== null) {
    $_SESSION['board'] = $newBoard;  // Update the board in the session
    // Switch the player for the next turn
    $_SESSION['currentPlayer'] = $_SESSION['currentPlayer'] === 'X' ? 'O' : 'X';

    if (checkWin($newBoard, $player)) {
        $output = ['status' => 'success', 'message' => "$player wins!", 'board' => $newBoard];
    } elseif (checkDraw($newBoard)) {
        $output = ['status' => 'success', 'message' => "It's a draw!", 'board' => $newBoard];
    } else {
        $output = ['status' => 'success', 'message' => 'Move made', 'board' => $newBoard];
    }
} else {
    $output = ['status' => 'error', 'message' => 'Invalid move'];
}

echo json_encode($output);
