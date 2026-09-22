<?php
/*
 * Get User Orders API
 * Retrieves all orders for the logged-in user
 */

header('Content-Type: application/json');
require_once 'db_config.php';
session_start();

// Check if user is logged in (from session or cookie)
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$userId) {
    // Check if remember cookie exists
    if (isset($_COOKIE['remember_user'])) {
        $userId = $_COOKIE['remember_user'];
    } else {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit;
    }
}

try {
    // Get user info
    $userStmt = $conn->prepare("SELECT id, name, username, email, phone FROM users WHERE id = ?");
    $userStmt->execute([$userId]);
    $user = $userStmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'User not found']);
        exit;
    }

    // Get user orders
    $ordersStmt = $conn->prepare(
        "SELECT id, product, quantity, location, order_status, created_at 
         FROM orders 
         WHERE user_id = ? 
         ORDER BY created_at DESC"
    );
    $ordersStmt->execute([$userId]);
    $orders = $ordersStmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'user' => $user,
        'orders' => $orders,
        'total_orders' => count($orders)
    ]);

} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
