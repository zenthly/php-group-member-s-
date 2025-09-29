<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = isset($_POST['num1']) ? (float)$_POST['num1'] : 0;
    $num2 = isset($_POST['num2']) ? (float)$_POST['num2'] : 0;dddd
    $op = isset($_POST['operation']) ? $_POST['operation'] : '';
    $result = '';
    if ($op === '+') {
        $result = $num1 + $num2;
        $msg = "$num1 + $num2 = $result";
    } elseif ($op === '-') {
        $result = $num1 - $num2;
        $msg = "$num1 - $num2 = $result";
    } elseif ($op === '*') {
        $result = $num1 * $num2;
        $msg = "$num1 * $num2 = $result";
    } elseif ($op === '/') {
        if ($num2 == 0) {
            $msg = "Error: Division by zero is not allowed.";
        } else {
            $result = $num1 / $num2;
            $msg = "$num1 / $num2 = $result";
        }
    } elseif ($op === '%') {
        if ($num2 == 0) {
            $msg = "Error: Modulo by zero is not allowed.";
        } else {
            $result = $num1 % $num2;
            $msg = "$num1 % $num2 = $result";
        }
    } else {
        $msg = "Invalid operation selected.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple PHP Calculator</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        input, select { width: 100%; padding: 8px; margin: 8px 0; }
        .result { margin-top: 16px; font-weight: bold; color: #464d3eff; }
        .error { color: #844680ff; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Simple PHP Calculator</h2>
        <form method="post">
            <label>First Number:</label>
            <input type="number" step="any" name="num1" required value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>">
            <label>Second Number:</label>
            <input type="number" step="any" name="num2" required value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>">
            <label>Operation:</label>
            <select name="operation" required>
                <option value="">Select</option>
                <option value="+" <?php if(isset($_POST['operation']) && $_POST['operation']=='+') echo 'selected'; ?>>Addition (+)</option>
                <option value="-" <?php if(isset($_POST['operation']) && $_POST['operation']=='-') echo 'selected'; ?>>Subtraction (-)</option>
                <option value="*" <?php if(isset($_POST['operation']) && $_POST['operation']=='*') echo 'selected'; ?>>Multiplication (*)</option>
                <option value="/" <?php if(isset($_POST['operation']) && $_POST['operation']=='/') echo 'selected'; ?>>Division (/)</option>
                <option value="%" <?php if(isset($_POST['operation']) && $_POST['operation']=='%') echo 'selected'; ?>>Modulo (%)</option>
            </select>
            <button type="submit">Calculate</button>
        </form>
        <?php if (isset($msg)) {
            $class = (strpos($msg, 'Error') === 0 || strpos($msg, 'Invalid') === 0) ? 'error' : 'result';
            echo "<div class='$class'>" . htmlspecialchars($msg) . "</div>";
        } ?>
    </div>
</body>
</html>
