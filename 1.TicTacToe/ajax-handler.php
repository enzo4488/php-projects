<?php
session_start();  // Start the session first
error_log(file_get_contents('php://input')); //Debugging
header('Content-Type: application/json'); // Set the header

include_once 'C:/Users/Enzo/Desktop/Xampp/htdocs/php-projects/1.TicTacToe/game/tic-tac-toe.php';

// Initialize the board if it doesn't exist in the session
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = [
        ['-', '-', '-'],
        ['-', '-', '-'],
        ['-', '-', '-']
    ];
}

$data = json_decode(file_get_contents('php://input'), true);
if ($data === null) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
    exit();
}

if (!isset($data['row'], $data['col'], $data['player'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
    exit();
}

$row = $data['row'];
$col = $data['col'];
$player = $data['player'];

// Retrieve the board from the session
$board = $_SESSION['board'];

$newBoard = makeMove($board, $row, $col, $player);
if ($newBoard !== null) {
    $_SESSION['board'] = $newBoard;  // Update the board in the session
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
