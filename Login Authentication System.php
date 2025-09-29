<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
<main class="card"><h1>Login</h1>
<form action="login.php" method="post">
  <label>Username: <input type="text" name="username" required></label>
  <label>Password: <input type="password" name="password" required></label>
  <button type="submit">Sign In</button>
</form>
</main>
</body>
</html>

<?php
$storedUser = 'admin';
$storedPass = 'Secret123'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    session_start();
    if (!isset($_SESSION['attempts'])) $_SESSION['attempts']=0;

    if ($_SESSION['attempts'] >= 5) {
        echo '<div class="result">Too many attempts. Try later.</div>'; exit;
    }

    if ($user === $storedUser && $pass === $storedPass) {
        echo '<!doctype html><html><body><main class="card"><h1>Welcome</h1><p>Login successful. Hello ' . htmlspecialchars($user) . '.</p></main></body></html>';
        $_SESSION['attempts']=0;
    } elseif ($user === $storedUser) {
        $_SESSION['attempts']++;
        echo '<!doctype html><html><body><main class="card"><h1>Wrong Password</h1><p>The username is correct but the password is wrong.</p><p><a href="login.html">Back</a></p></main></body></html>';
    } elseif ($pass === $storedPass) {
        $_SESSION['attempts']++;
        echo '<!doctype html><html><body><main class="card"><h1>Wrong Username</h1><p>The password matches but the username is wrong.</p><p><a href="login.html">Back</a></p></main></body></html>';
    } else {
        $_SESSION['attempts']++;
        echo '<!doctype html><html><body><main class="card"><h1>Invalid Credentials</h1><p>Both username and password are incorrect.</p><p><a href="login.html">Back</a></p></main></body></html>';
    }
}
?>
