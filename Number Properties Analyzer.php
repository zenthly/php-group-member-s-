<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Number Analyzer</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
<main class="card"><h1>Number Analyzer</h1>
<form action="number_analyzer.php" method="post">
  <label>Integer: <input type="number" name="number" required></label>
  <button type="submit">Analyze</button>
</form>
</main>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = isset($_POST['number']) ? intval($_POST['number']) : 0;
    $out = [];
    if ($n > 0) $out[] = 'Positive';
    elseif ($n < 0) $out[] = 'Negative';
    else $out[] = 'Zero';
    $out[] = ($n % 2 === 0) ? 'Even' : 'Odd';
    $abs = abs($n);
    if ($abs <= 9) $out[] = 'Single digit';
    elseif ($abs <= 99) $out[] = 'Double digit';
    else $out[] = 'More than two digits';
    $n += 5;
    $out[] = 'After adding 5: ' . $n;
    echo '<!doctype html><html><body><main class="card"><h1>Analysis</h1><ul>';
    foreach ($out as $line) echo '<li>' . htmlspecialchars($line) . '</li>';
    echo '</ul><p><a href="number_analyzer.html">Back</a></p></main></body></html>';
} ?>
