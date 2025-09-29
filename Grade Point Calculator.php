<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Grade Calculator</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
<main class="card"><h1>Grade Point Calculator</h1>
<form action="grade_calc.php" method="post">
  <label>Subject 1: <input type="number" name="s1" min="0" max="100" required></label>
  <label>Subject 2: <input type="number" name="s2" min="0" max="100" required></label>
  <label>Subject 3: <input type="number" name="s3" min="0" max="100" required></label>
  <button type="submit">Compute Grade</button>
</form>
</main>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $s1 = floatval($_POST['s1'] ?? 0);
    $s2 = floatval($_POST['s2'] ?? 0);
    $s3 = floatval($_POST['s3'] ?? 0);
    $total = $s1 + $s2 + $s3;
    $percent = ($total / 300) * 100;
    if ($percent >= 90) $grade='A+'; elseif ($percent >= 80) $grade='A';
    elseif ($percent >= 70) $grade='B+'; elseif ($percent >= 60) $grade='B';
    elseif ($percent >= 50) $grade='C'; else $grade='F';
    $status = ($percent >= 50) ? 'Pass' : 'Fail';
    echo '<!doctype html><html><body><main class="card"><h1>Results</h1><div class="result">';
    echo '<p>Total: ' . number_format($total,2) . '/300</p><p>Percentage: ' . number_format($percent,2) . '%</p>';
    echo '<p>Grade: ' . $grade . '</p><p>Status: ' . $status . '</p></div><p><a href="grade_calc.html">Back</a></p></main></body></html>';
} ?>
