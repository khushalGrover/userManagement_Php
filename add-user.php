<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'] ?? null;
$email = $data['email'] ?? null;

if (!$name || !$email) {
    http_response_code(400);
    echo json_encode(['error' => 'Name and email required']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

echo json_encode(['success' => true, 'user_id' => $stmt->insert_id]);
$stmt->close();
$conn->close();
?>