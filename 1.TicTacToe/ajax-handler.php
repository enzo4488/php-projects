<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$output = ['status' => 'success', 'message' => 'Move made', 'board' => $newBoard];
error_log(print_r($output, true));
echo json_encode($output);


session_start();  // Start the session
header('Content-Type: application/json');

include_once '../game/tic-tac-toe.php';  // Includes functions like makeMove, checkWin, etc.

// Initialize the board if it doesn't exist in the session
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = [
        ['-', '-', '-'],
        ['-', '-', '-'],
        ['-', '-', '-']
    ];
}

$data = json_decode(file_get_contents('php://input'), true);
$row = $data['row'];
$col = $data['col'];
$player = $data['player'];

// Retrieve the board from the session
$board = $_SESSION['board'];

$newBoard = makeMove($board, $row, $col, $player);
if ($newBoard !== null) {
    $_SESSION['board'] = $newBoard;  // Update the board in the session
    if (checkWin($newBoard, $player)) {
        echo json_encode(['status' => 'success', 'message' => "$player wins!", 'board' => $newBoard]);
    } elseif (checkDraw($newBoard)) {
        echo json_encode(['status' => 'success', 'message' => "It's a draw!", 'board' => $newBoard]);
    } else {
        echo json_encode(['status' => 'success', 'message' => 'Move made', 'board' => $newBoard]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid move']);
}