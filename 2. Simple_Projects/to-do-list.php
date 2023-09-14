<?php
$taskList = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newTask = $_POST['newTask'];
    
    if (!empty($newTask)) {
        $taskList[] = $newTask;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO-DO LIST</title>
</head>
<body>

    <h1>To-do List</h1>

    <h2>This is a simple yet intuitive to-do list</h2>

    <form action=" " method="post">
    <!-- Input field for new task -->
    <input type="text" name="newTask" placeholder="Enter new task">
    <!-- Button to add new task -->
    <button type="submit">Add</button>
    </form>
    <!-- Area to display the list of tasks -->
    <ul id="taskList">
        <!-- Tasks will be added here -->
        <?php
        foreach ($taskList as $task) {
            echo "<li>" . htmlspecialchars($task) . "</li>";
        }
        ?>
    </ul>

</body>
</html>