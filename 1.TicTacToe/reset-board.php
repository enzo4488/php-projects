<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['board'])) {
    $_SESSION['board'] = [
        ['-', '-', '-'],
        ['-', '-', '-'],
        ['-', '-', '-']
    ];
    $_SESSION['currentPlayer'] = 'X';
    echo json_encode(['status' => 'success', 'message' => 'Board reset', 'board' => $_SESSION['board']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to reset board']);
}
?>
