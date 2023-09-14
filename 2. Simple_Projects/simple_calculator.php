<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables
    $firstNumber = $_POST['first_number'];
    $secondNumber = $_POST['second_number'];
    $operator = $_POST['operator'];

    // Data validation
    if (!is_numeric($firstNumber) || !is_numeric($secondNumber)) {
        echo "Please enter valid numbers.";
        return;
    }

    if (!in_array($operator, ['+', '-', '*', '/'])) {
        echo "Invaid operator.";
        return;
    }

    // Perform calculation
    function calculate($firstNumber, $secondNumber, $operator) {
        switch ($operator) {
            case '+':
                return $firstNumber + $secondNumber;
            case '-':
                return $firstNumber - $secondNumber;
            case '*':
                return $firstNumber * $secondNumber;
            case '/':
                    if ($secondNumber == 0) {
                        return "Cannot divide by zero";
                    }
                    return $firstNumber / $secondNumber;
        }
    }

    // Display result
    $result = calculate($firstNumber, $secondNumber, $operator);
    echo "The result is: " . $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator in PHP</title>
</head>
<body>

<h1>Simple Calculator</h1>

<form action="simple_calculator.php" method="post">
    <!-- Input for first number-->
    <label for="first_number">Number 1:</label>
    <input type="number" id="first_number" name="first_number">
    <br>
    <!-- Input for second number-->
    <label for="second_number">Number 2:</label>
    <input type="number" id="second_number" name="second_number">
    <br>
    <!-- Dropdown for operator-->
    <label for="operator">Operator:</label>
    <select id="operator" name="operator"> 
        <option value="+">Addition (+)</option>
        <option value="-">Subtraction (-)</option>
        <option value="*">Multiplication (*)</option>
        <option value="/">Division (/)</option>
    </select>
    <br>

    <!-- Submit button -->
    <input type="submit" value="Calculate">
</form>

</body>
</html>