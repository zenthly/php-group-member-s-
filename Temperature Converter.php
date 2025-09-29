<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Temperature Converter</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
<main class="card"><h1>Temperature Converter</h1>
<form action="temp_converter.php" method="post">
  <label>Temperature: <input type="number" step="any" name="temp" required></label>
  <label>Unit:
    <select name="unit"><option value="C">Celsius (C)</option><option value="F">Fahrenheit (F)</option></select>
  </label>
  <button type="submit">Convert</button>
</form>
</main>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $temp = floatval($_POST['temp'] ?? 0);
    $unit = strtoupper($_POST['unit'] ?? 'C');
    if ($unit === 'C') {
        $f = ($temp * 9/5) + 32; $c = $temp;
    } elseif ($unit === 'F') {
        $c = ($temp - 32) * 5/9; $f = $temp;
    } else { echo 'Invalid unit.'; exit; }
    echo '<!doctype html><html><body><main class="card"><h1>Conversion</h1><div class="result">' . htmlspecialchars(number_format($c,2)) . ' °C = ' . htmlspecialchars(number_format($f,2)) . ' °F</div>';
    if ($c < 0) echo '<p>It\'s freezing cold!</p>'; elseif ($c < 20) echo '<p>Weather is cool.</p>'; else echo '<p>It\'s warm/hot.</p>';
    echo '<p><a href="temp_converter.html">Back</a></p></main></body></html>';
} ?>
