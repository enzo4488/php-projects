<?php
include_once '../includes/database.php';
include_once '../game/tic-tac-toe.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit();
}

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

// Update wins and losses

if (checkWin($board, 'X')) {
    echo "Player X wins!" . PHP_EOL;
    if ($_SESSION['currentPlayer'] === 'X') {
        $pdo = getDatabaseConnection();
        $sql = "UPDATE users SET wins = wins + 1 WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
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
    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>

    <form action="" method="post">
        Row: <input type="number" name="row" min="0" max="2">
        Column: <input type="number" name="col" min="0" max="2">
        <input type="submit" value="Make Move">
    </form>

    <pre>
    <?php
    foreach ($_SESSION['board'] as $row) {
        echo implode(' ', $row) . PHP_EOL;
    }
    ?>
    </pre>
</body>
</html>
