<?php
header('Content-Type: application/json');
require 'db.php';

$query = $_GET['query'] ?? '';

$stmt = $conn->prepare("SELECT * FROM users WHERE name LIKE ?");
$searchTerm = "%" . $query . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
echo json_encode($users);
$stmt->close();
$conn->close();
?>