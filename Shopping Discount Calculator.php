<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Discount Calculator</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
<main class="card"><h1>Shopping Discount Calculator</h1>
<form action="discount.php" method="post">
  <label>Original Price: <input type="number" step="0.01" name="price" required></label>
  <button type="submit">Calculate</button>
</form>
</main>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $price = floatval($_POST['price'] ?? 0);
    $discount = 0.0;
    if ($price > 200) $discount = 0.15;
    elseif ($price > 100) $discount = 0.10;
    elseif ($price > 50) $discount = 0.05;
    $discountAmount = $price * $discount;
    $final = $price - $discountAmount;
    echo '<!doctype html><html><body><main class="card"><h1>Discount Result</h1>';
    echo '<div class="result"><p>Original Price: $' . number_format($price,2) . '</p>';
    echo '<p>Discount: ' . ($discount*100) . '%</p>';
    echo '<p>Discount Amount: $' . number_format($discountAmount,2) . '</p>';
    echo '<p>Final Price: $' . number_format($final,2) . '</p></div>';
    echo '<p><a href="discount.html">Back</a></p></main></body></html>';
} ?>
