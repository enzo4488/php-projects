<?php
session_start();

if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = [
        ['-', '-', '-'],
        ['-', '-', '-'],
        ['-', '-', '-']
    ];
    $_SESSION['currentPlayer'] = 'X';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $row = $_POST['row'];
    $col = $_POST['col'];

    // Make the move
    if ($_SESSION['board'][$row][$col] === '-') {
        $_SESSION['board'][$row][$col] = $_SESSION['currentPlayer'];

        // Switch player
        $_SESSION['currentPlayer'] = $_SESSION['currentPlayer'] === 'X' ? 'O' : 'X';
    }
}

// Display the board
echo '<pre>';
foreach ($_SESSION['board'] as $row) {
    echo implode(' ', $row) . PHP_EOL;
}
echo '</pre>';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tic-Tac-Toe</title>
</head>
<body>
    <form action="" method="post">
        Row: <input type="number" name="row" min="0" max="2">
        Column: <input type="number" name="col" min="0" max="2">
        <input type="submit" value="Make Move">
    </form>
</body>
</html>
