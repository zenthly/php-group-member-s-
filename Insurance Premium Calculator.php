<!doctype html><html lang="en"><head><meta charset="utf-8"><title>Insurance Premium</title><link rel="stylesheet" href="styles.css"></head><body>
<main class="card"><h1>Insurance Premium Calculator</h1>
<form action="insurance.php" method="post">
  <label>Age: <input type="number" name="age" min="16" required></label>
  <label>Years Driving Experience: <input type="number" name="exp" min="0" required></label>
  <label>Number of Accidents: <input type="number" name="acc" min="0" required></label>
  <label>Car Type: <input type="text" name="car" required></label>
  <button type="submit">Calculate Premium</button>
</form></main></body></html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $age = intval($_POST['age'] ?? 0);
    $exp = intval($_POST['exp'] ?? 0);
    $acc = intval($_POST['acc'] ?? 0);
    $car = trim($_POST['car'] ?? '');

    $risk = 'Medium';
    if ((($age < 25) || ($age > 70)) && $acc > 0) {
        $risk = 'High';
    } elseif (($age >=25 && $age <=70) && ($acc == 0 || $exp > 10)) {
        $risk = 'Medium';
    } elseif ($age >=30 && $age <=60 && $exp > 5 && $acc == 0) {
        $risk = 'Low';
    }
    $base = 500;
    if ($risk === 'High') $premium = $base * 1.8;
    elseif ($risk === 'Medium') $premium = $base * 1.2;
    else $premium = $base * 0.8;
    $discount = (stripos($car,'safety') !== false) ? 0.10 : 0.0;
    $final = $premium * (1 - $discount);

    echo '<!doctype html><html><body><main class="card"><h1>Insurance Result</h1>';
    echo '<p>Risk Level: ' . $risk . '</p>';
    echo '<p>Premium before discount: $' . number_format($premium,2) . '</p>';
    echo '<p>Discount: ' . ($discount*100) . '%</p>';
    echo '<p>Final Premium: $' . number_format($final,2) . '</p>';
    echo '<p><a href="insurance.html">Back</a></p></main></body></html>';
}
?>
