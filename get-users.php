<?php
header('Connect-Type: Application/json');
require 'db.php';
$result = $conn->query('SELECT * FROM users');

$users = [];
while ($row = $result->fetch_assoc()) {
    $user[] = $row;
}
echo json_encode($users);
$conn->close();

?>