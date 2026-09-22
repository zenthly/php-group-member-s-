<?php
header('Content-Type: application/json');
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$phone = trim($data['phone'] ?? '');
$message = trim($data['message'] ?? '');

// Validation
if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill all required fields']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

if (!preg_match('/^[0-9\+\-\(\)\s]+$/', $phone)) {
    echo json_encode(['success' => false, 'message' => 'Invalid phone format']);
    exit;
}

if (strlen($message) < 10) {
    echo json_encode(['success' => false, 'message' => 'Message must be at least 10 characters']);
    exit;
}

try {
    // Insert contact message into database
    $stmt = $conn->prepare(
        "INSERT INTO contact_messages (name, email, phone, message, read_status) 
         VALUES (?, ?, ?, ?, FALSE)"
    );
    $stmt->execute([$name, $email, $phone, $message]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Your message has been sent successfully! We will contact you soon.'
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
