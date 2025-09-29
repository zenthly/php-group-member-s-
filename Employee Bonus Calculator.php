<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Employee Bonus</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
<main class="card"><h1>Employee Bonus Calculator</h1>
<form action="bonus.php" method="post">
  <label>Years of Service: <input type="number" name="years" min="0" required></label>
  <label>Performance Rating (1-5): <input type="number" name="rating" min="1" max="5" required></label>
  <label>Department: <input type="text" name="department" required></label>
  <label>In Probation? 
    <select name="probation"><option value="no">No</option><option value="yes">Yes</option></select>
  </label>
  <button type="submit">Calculate Bonus</button>
</form>
</main>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $years = intval($_POST['years'] ?? 0);
    $rating = intval($_POST['rating'] ?? 0);
    $dept = trim($_POST['department'] ?? '');
    $prob = ($_POST['probation'] ?? 'no') === 'yes';

    $eligible = false;
    $bonusPercent = 0;

    if (!$prob && (($years >=2 && $rating >=3) || (strcasecmp($dept,'Sales')===0 && $rating>=4))) {
        $eligible = true;
        if ($rating >=5) $bonusPercent = 0.20;
        elseif ($rating >=4) $bonusPercent = 0.10;
        else $bonusPercent = 0.05;
    }

    echo '<!doctype html><html><body><main class="card"><h1>Bonus Result</h1>';
    if ($eligible) {
        echo '<p>Eligible for bonus: Yes</p>';
        echo '<p>Bonus Percentage: ' . ($bonusPercent*100) . '%</p>';
    } else {
        echo '<p>Eligible for bonus: No</p>';
    }
    echo '<p><a href="bonus.html">Back</a></p></main></body></html>';
}
?>
