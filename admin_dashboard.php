<?php
/*
 * Admin Dashboard - View All Data
 * This file allows you to see all registered users, orders, and contact messages
 * Access it at: http://localhost/PROJECT/admin_dashboard.php
 */

require_once 'db_config.php';
session_start();

// Simple password protection
$admin_password = 'admin123'; // Change this to a secure password
$is_authenticated = false;

// Check if user is attempting to login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $is_authenticated = true;
    } else {
        $error = "Invalid password";
    }
}

// Check if already authenticated
if (isset($_SESSION['admin_logged_in'])) {
    $is_authenticated = true;
}

if (!$is_authenticated) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Login</title>
        <style>
            body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
            .login-box { width: 300px; margin: 50px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            h2 { text-align: center; color: #f7c948; }
            input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; }
            button { width: 100%; padding: 12px; background: #f7c948; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
            button:hover { background: #ffd766; }
            .error { color: red; text-align: center; }
        </style>
    </head>
    <body>
        <div class="login-box">
            <h2>Admin Dashboard</h2>
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="password" name="password" placeholder="Enter admin password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Get statistics
$users_count = $conn->query("SELECT COUNT(*) FROM users")->fetch(PDO::FETCH_COLUMN);
$orders_count = $conn->query("SELECT COUNT(*) FROM orders")->fetch(PDO::FETCH_COLUMN);
$messages_count = $conn->query("SELECT COUNT(*) FROM contact_messages")->fetch(PDO::FETCH_COLUMN);
$active_logins = $conn->query("SELECT COUNT(*) FROM login_activity WHERE is_active = TRUE")->fetch(PDO::FETCH_COLUMN);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Beer Delivery</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #f7c948; color: #111; padding: 20px; text-align: center; }
        .header a { float: right; background: #111; color: #f7c948; padding: 8px 15px; border-radius: 4px; text-decoration: none; }
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; }
        .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-box { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center; }
        .stat-box h3 { color: #f7c948; font-size: 28px; }
        .stat-box p { color: #666; }
        .section { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .section h2 { color: #f7c948; border-bottom: 2px solid #f7c948; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #f0f0f0; padding: 12px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f9f9f9; }
        .status { padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .status-pending { background: #ffc107; color: white; }
        .status-confirmed { background: #28a745; color: white; }
        .status-delivered { background: #007bff; color: white; }
        .read { background: #e8f5e9; }
        .active-badge { background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🍺 Beer Delivery - Admin Dashboard</h1>
        <a href="?logout=true">Logout</a>
    </div>

    <div class="container">
        <!-- Statistics -->
        <div class="stats">
            <div class="stat-box">
                <h3><?php echo $users_count; ?></h3>
                <p>Total Users</p>
            </div>
            <div class="stat-box">
                <h3><?php echo $orders_count; ?></h3>
                <p>Total Orders</p>
            </div>
            <div class="stat-box">
                <h3><?php echo $messages_count; ?></h3>
                <p>Contact Messages</p>
            </div>
            <div class="stat-box">
                <h3><?php echo $active_logins; ?></h3>
                <p>Currently Logged In</p>
            </div>
        </div>

        <!-- Users Section -->
        <div class="section">
            <h2>📋 Registered Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Registered Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users = $conn->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($users as $user):
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td><?php echo date('M d, Y H:i', strtotime($user['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Currently Logged In Section -->
        <div class="section">
            <h2>👥 Currently Logged In Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Login Time</th>
                        <th>Status</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $active_users = $conn->query("SELECT * FROM login_activity WHERE is_active = TRUE ORDER BY login_time DESC")->fetchAll(PDO::FETCH_ASSOC);
                    if (count($active_users) == 0) {
                        echo "<tr><td colspan='8' style='text-align: center; color: #999;'>No users currently logged in</td></tr>";
                    } else {
                        foreach ($active_users as $log):
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($log['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($log['name']); ?></td>
                                <td><?php echo htmlspecialchars($log['username']); ?></td>
                                <td><?php echo htmlspecialchars($log['email']); ?></td>
                                <td><?php echo htmlspecialchars($log['phone'] ?? '-'); ?></td>
                                <td><?php echo date('M d, Y H:i:s', strtotime($log['login_time'])); ?></td>
                                <td><span class="active-badge">🟢 Active</span></td>
                                <td><?php echo htmlspecialchars($log['ip_address'] ?? '-'); ?></td>
                            </tr>
                        <?php
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Login Activity Section -->
        <div class="section">
            <h2>📊 Login Activity History</h2>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Login Time</th>
                        <th>Logout Time</th>
                        <th>Status</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $login_history = $conn->query("SELECT * FROM login_activity ORDER BY login_time DESC LIMIT 50")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($login_history as $log):
                        $status = $log['is_active'] ? '<span class="active-badge">🟢 Active</span>' : '<span style="color: #999;">Logged Out</span>';
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($log['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($log['name']); ?></td>
                            <td><?php echo htmlspecialchars($log['username']); ?></td>
                            <td><?php echo htmlspecialchars($log['email']); ?></td>
                            <td><?php echo date('M d, Y H:i:s', strtotime($log['login_time'])); ?></td>
                            <td><?php echo $log['logout_time'] ? date('M d, Y H:i:s', strtotime($log['logout_time'])) : '-'; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo htmlspecialchars($log['ip_address'] ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Orders Section -->
        <div class="section">
            <h2>📦 All Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($orders as $order):
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['name']); ?></td>
                            <td><?php echo htmlspecialchars($order['email']); ?></td>
                            <td><?php echo htmlspecialchars($order['phone']); ?></td>
                            <td><?php echo htmlspecialchars($order['product']); ?></td>
                            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($order['location']); ?></td>
                            <td>
                                <span class="status status-<?php echo strtolower($order['order_status']); ?> status-<?php echo str_replace(' ', '-', strtolower($order['order_status'])); ?>">
                                    <?php echo htmlspecialchars($order['order_status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Contact Messages Section -->
        <div class="section">
            <h2>💬 Contact Messages</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($messages as $msg):
                    ?>
                        <tr class="<?php echo $msg['read_status'] ? 'read' : 'unread'; ?>">
                            <td><?php echo htmlspecialchars($msg['id']); ?></td>
                            <td><?php echo htmlspecialchars($msg['name']); ?></td>
                            <td><?php echo htmlspecialchars($msg['email']); ?></td>
                            <td><?php echo htmlspecialchars($msg['phone']); ?></td>
                            <td><?php echo htmlspecialchars(substr($msg['message'], 0, 50)) . '...'; ?></td>
                            <td><?php echo $msg['read_status'] ? 'Read' : 'Unread'; ?></td>
                            <td><?php echo date('M d, Y H:i', strtotime($msg['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin_dashboard.php');
    exit;
}
?>
