<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;
$name = $data['name'] ?? null;
$email = $data['email'] ?? null;

if (!$id || !$name || !$email) {
    http_response_code(400);
    echo json_encode(['error' => 'ID, Name, and Email required']);
    exit;
}

$stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
$stmt->bind_param("ssi", $name, $email, $id);
$stmt->execute();

echo json_encode(['success' => true]);
$stmt->close();
$conn->close();
?>